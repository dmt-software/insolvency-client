<?php

namespace DMT\Insolvency;

use DateTime;
use DMT\CommandBus\Validator\ValidationMiddleware;
use DMT\Http\Client\RequestHandler;
use DMT\Insolvency\Exception\Exception;
use DMT\Insolvency\Exception\ExceptionMiddleware;
use DMT\Insolvency\Http\GetReportHandler;
use DMT\Insolvency\Http\Middleware\ExceptionMiddleware as HttpExceptionMiddleware;
use DMT\Insolvency\Http\Middleware\SoapActionMiddleware;
use DMT\Insolvency\Http\Request\GetReport;
use DMT\Insolvency\Http\Response\GetReportResponse;
use DMT\Insolvency\Model\BeschikbareVerslagen;
use DMT\Insolvency\Model\Document;
use DMT\Insolvency\Model\Insolvente;
use DMT\Insolvency\Model\LastUpdate;
use DMT\Insolvency\Model\PublicatieLijst;
use DMT\Insolvency\Model\VerwijderdePublicatieLijst;
use DMT\Insolvency\Soap\Handler as SoapHandler;
use DMT\Insolvency\Soap\Request;
use DMT\Insolvency\Soap\Request as SoapRequest;
use DMT\Insolvency\Soap\Response;
use DMT\Insolvency\Soap\Serializer\SoapSerializer;
use GuzzleHttp\Client as HttpClient;
use JMS\Serializer\SerializerInterface;
use League\Tactician\CommandBus;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;
use League\Tactician\Handler\Locator\CallableLocator;
use League\Tactician\Handler\MethodNameInflector\HandleInflector;
use League\Tactician\Plugins\LockingMiddleware;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;

/**
 * Class Client
 */
final class Client
{
    private Config $config;
    private ClientInterface $client;
    private RequestFactoryInterface $requestFactory;
    private SerializerInterface $serializer;
    private CommandBus $commandBus;

    /**
     * @param Config $config
     * @param ClientInterface $client
     * @param RequestFactoryInterface $requestFactory
     * @param SoapSerializer|null $serializer
     */
    public function __construct(
        Config                  $config,
        ClientInterface         $client,
        RequestFactoryInterface $requestFactory,
        SoapSerializer          $serializer = null
    )
    {
        $this->config = $config;
        $this->client = $client;
        $this->requestFactory = $requestFactory;
        $this->serializer = $serializer ?? new SoapSerializer($this, $config);

        $this->commandBus = new CommandBus([
            new LockingMiddleware(),
            new ExceptionMiddleware(),
            new ValidationMiddleware(),
            new CommandHandlerMiddleware(
                new ClassNameExtractor(),
                new CallableLocator(
                    function (string $request) {
                        return $this->getHandler($request);
                    }
                ),
                new HandleInflector()
            )
        ]);
    }

    /**
     * Search for publications of a specific insolvency.
     *
     * @param string $insolvencyID the insolvency identification.
     * @param string|null $court the count (number) where the insolvency is registered.
     *
     * @return PublicatieLijst
     * @throws Exception
     */
    public function searchInsolvencyId(string $insolvencyID, string $court = null): PublicatieLijst
    {
        $request = new Request\SearchInsolvencyID();
        $request->insolvencyID = $insolvencyID;
        $request->court = $court;

        /** @var Response\SearchInsolvencyIDResponse $response */
        $response = $this->process($request);

        return $response->result->publicatieLijst;
    }

    /**
     * Search for publications for a person.
     *
     * @param DateTime|null $dateOfBirth the date of birth of the person.
     * @param string|null $prefix the surname prefix.
     * @param string|null $surname the surname of the person.
     * @param int|null $houseNumber the house number of the person's address.
     * @param string|null $postalCode the postcode of the person's address.
     *
     * @return PublicatieLijst
     * @throws Exception
     */
    public function searchNaturalPerson(
        DateTime $dateOfBirth = null,
        string   $prefix = null,
        string   $surname = null,
        int      $houseNumber = null,
        string   $postalCode = null
    ): PublicatieLijst
    {
        $request = new Request\SearchNaturalPerson();
        $request->dateOfBirth = $dateOfBirth;
        $request->prefix = $prefix;
        $request->surname = $surname;
        $request->houseNumber = $houseNumber;
        $request->postalCode = $postalCode;

        /** @var Response\SearchNaturalPersonResponse $response */
        $response = $this->process($request);

        return $response->result->publicatieLijst;
    }

    /**
     * Search for publications of an undertaking.
     *
     * @param string|null $name the name of the undertaking.
     * @param string|null $commercialRegisterID the chamber of commerce number.
     * @param string|null $postalCode the postcode of the undertaking's address.
     * @param int|null $houseNumber the house number of the undertaking' address.
     *
     * @return PublicatieLijst
     * @throws Exception
     */
    public function searchUndertaking(
        string $name = null,
        string $commercialRegisterID = null,
        string $postalCode = null,
        int    $houseNumber = null
    ): PublicatieLijst
    {
        $request = new Request\SearchUndertaking();
        $request->name = $name;
        $request->commercialRegisterID = $commercialRegisterID;
        $request->postalCode = $postalCode;
        $request->houseNumber = $houseNumber;

        /** @var Response\SearchUndertakingResponse $response */
        $response = $this->process($request);

        return $response->result->publicatieLijst;
    }

    /**
     * Get insolvency case.
     *
     * @param string $publicationNumber the publication number of the case.
     * @param bool $includeReports set to true to include reports.
     *
     * @return Insolvente
     * @throws Exception
     */
    public function getCase(string $publicationNumber, bool $includeReports = false): Insolvente
    {
        $request = $includeReports ? new Request\GetCaseWithReports() : new Request\GetCase();
        $request->publicationNumber = $publicationNumber;

        /** @var Response\GetCaseResponse $response */
        $response = $this->process($request);

        return $response->result->inspubWebserviceInsolvente->insolvente;
    }

    /**
     * Get a report for an insolvency.
     *
     * @param string $reportId the report identification number.
     *
     * @return Document
     * @throws Exception
     */
    public function getReport(string $reportId): Document
    {
        $request = new GetReport();
        $request->reportId = $reportId;

        /** @var GetReportResponse $response */
        $response = $this->process($request);

        return $response->result->report;

    }

    /**
     * Get the date when the latest publication is added.
     *
     * @return LastUpdate
     * @throws Exception
     */
    public function getLastUpdate(): LastUpdate
    {
        /** @var Response\GetLastUpdateResponse $response */
        $response = $this->process(new Request\GetLastUpdate());

        return $response->result->lastUpdate;
    }

    /**
     * Search for publications of a specific date.
     *
     * @param DateTime $date tne date of the publications to look up.
     * @param string $court the court (number) where the publications are registered.
     * @param string|null $pubType the type of publication.
     *
     * @return PublicatieLijst
     * @throws Exception
     */
    public function searchByDate(DateTime $date, string $court, string $pubType = null): PublicatieLijst
    {
        $request = new Request\SearchByDate();
        $request->date = $date;
        $request->court = $court;
        $request->pubType = $pubType;

        /** @var Response\SearchByDateResponse $response */
        $response = $this->process($request);

        return $response->result->publicatieLijst;
    }

    /**
     * Search for publications of the last mutated/added insolvencies for data replication.
     *
     * @param DateTime $modifyDate the modified date since.
     *
     * @return PublicatieLijst
     * @throws Exception
     */
    public function searchModifiedSince(DateTime $modifyDate): PublicatieLijst
    {
        $request = new Request\SearchModifiedSince();
        $request->modifyDate = $modifyDate;

        /** @var Response\SearchModifiedSinceResponse $response */
        $response = $this->process($request);

        return $response->result->publicatieLijst;
    }

    /**
     * Search for removed publications for data replication.
     *
     * @param DateTime $modifyDate the modified date since.
     *
     * @return VerwijderdePublicatieLijst
     * @throws Exception
     */
    public function searchRemovedSince(DateTime $modifyDate): VerwijderdePublicatieLijst
    {
        $request = new Request\SearchRemovedSince();
        $request->modifyDate = $modifyDate;

        /** @var Response\SearchRemovedSinceResponse $response */
        $response = $this->process($request);

        return $response->result->verwijderdePublicatieLijst;
    }

    /**
     * Search for added and modified reposts in a given time period.
     *
     * @param DateTime $datetimeFrom the start date.
     * @param DateTime|null $datetimeTo the end date.
     *
     * @return BeschikbareVerslagen
     * @throws Exception
     */
    public function searchReportsSince(DateTime $datetimeFrom, DateTime $datetimeTo = null): BeschikbareVerslagen
    {
        $request = new Request\SearchReportsSince();
        $request->datetimeFrom = $datetimeFrom;
        $request->datetimeTo = $datetimeTo ?? new DateTime();

        /** @var Response\SearchReportsSinceResponse $response */
        $response = $this->process($request);

        return $response->result->beschikbareVerslagen;
    }

    /**
     * Process a request.
     *
     * @param Request|GetReport $request
     *
     * @return Response|GetReportResponse
     * @throws Exception
     */
    private function process($request)
    {
        return $this->commandBus->handle($request);
    }

    /**
     * @param string $request
     * @return SoapHandler|object
     * @internal
     */
    private function getHandler(string $request)
    {
        $exceptionMiddleware = new HttpExceptionMiddleware();
        if (!is_a($request, SoapRequest::class, true)) {
            return new GetReportHandler(
                $this->config,
                new RequestHandler($this->client, $exceptionMiddleware),
                $this->requestFactory
            );
        }

        $soapActionMiddleware =new SoapActionMiddleware();
        return new SoapHandler(
            $this->config,
            new RequestHandler($this->client, $exceptionMiddleware, $soapActionMiddleware),
            $this->requestFactory,
            $this->serializer
        );
    }
}
