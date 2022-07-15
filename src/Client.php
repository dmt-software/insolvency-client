<?php

namespace DMT\Insolvency;

use DMT\CommandBus\Validator\ValidationMiddleware;
use DMT\Insolvency\Exception\Exception;
use DMT\Insolvency\Exception\ExceptionMiddleware;
use DMT\Insolvency\Http\GetReportHandler;
use DMT\Insolvency\Http\Middleware\ExceptionMiddleware as HttpExceptionMiddleware;
use DMT\Insolvency\Http\Middleware\SoapActionMiddleware;
use DMT\Insolvency\Http\Request\GetReport;
use DMT\Insolvency\Http\Response\GetReportResponse;
use DMT\Insolvency\Soap\Handler as SoapHandler;
use DMT\Insolvency\Soap\Request;
use DMT\Insolvency\Soap\Request as SoapRequest;
use DMT\Insolvency\Soap\Response;
use DMT\Insolvency\Soap\Serializer\SoapSerializer;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use JMS\Serializer\SerializerInterface;
use League\Tactician\CommandBus;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;
use League\Tactician\Handler\Locator\CallableLocator;
use League\Tactician\Handler\MethodNameInflector\HandleInflector;
use League\Tactician\Plugins\LockingMiddleware;

/**
 * Class Client
 */
class Client
{
    /** @var Config $config */
    protected $config;

    /** @var SerializerInterface|null $serializer */
    protected $serializer;

    /** @var CommandBus $commandBus */
    protected $commandBus;

    /**
     * Client constructor.
     *
     * @param Config $config
     * @param SerializerInterface|null $serializer
     */
    public function __construct(Config $config, SerializerInterface $serializer = null)
    {
        $this->config = $config;
        $this->serializer = $serializer ?? new SoapSerializer($this, $config);

        $this->commandBus = new CommandBus([
            new LockingMiddleware(),
            new ExceptionMiddleware(),
            new ValidationMiddleware(),
            new CommandHandlerMiddleware(
                new ClassNameExtractor(),
                new CallableLocator([$this, 'getHandler']),
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
     * @return Response|Response\SearchInsolvencyIDResponse
     * @throws Exception
     */
    public function searchInsolvencyId(string $insolvencyID, string $court = null): Response\SearchInsolvencyIDResponse
    {
        $request = new Request\SearchInsolvencyID();
        $request->insolvencyID = $insolvencyID;
        $request->court = $court;

        return $this->process($request);
    }

    /**
     * Search for publications for a person.
     *
     * @param \DateTime|null $dateOfBirth the date of birth of the person.
     * @param string|null $prefix the surname prefix.
     * @param string|null $surname the surname of the person.
     * @param int|null $houseNumber the house number of the person's address.
     * @param string|null $postalCode the postcode of the person's address.
     *
     * @return Response|Response\SearchNaturalPersonResponse
     * @throws Exception
     */
    public function searchNaturalPerson(
        \DateTime $dateOfBirth = null,
        string $prefix = null,
        string $surname = null,
        int $houseNumber = null,
        string $postalCode = null
    ): Response\SearchNaturalPersonResponse {
        $request = new Request\SearchNaturalPerson();
        $request->dateOfBirth = $dateOfBirth;
        $request->prefix = $prefix;
        $request->surname = $surname;
        $request->houseNumber = $houseNumber;
        $request->postalCode = $postalCode;

        return $this->process($request);
    }

    /**
     * Search for publications of an undertaking.
     *
     * @param string|null $name the name of the undertaking.
     * @param string|null $commercialRegisterID the chamber of commerce number.
     * @param string|null $postalCode the postcode of the undertaking's address.
     * @param int|null $houseNumber the house number of the undertaking' address.
     *
     * @return Response|Response\SearchUndertakingResponse
     * @throws Exception
     */
    public function searchUndertaking(
        string $name = null,
        string $commercialRegisterID = null,
        string $postalCode = null,
        int $houseNumber = null
    ): Response\SearchUndertakingResponse {
        $request = new Request\SearchUndertaking();
        $request->name = $name;
        $request->commercialRegisterID = $commercialRegisterID;
        $request->postalCode = $postalCode;
        $request->houseNumber = $houseNumber;

        return $this->process($request);
    }

    /**
     * Get insolvency case.
     *
     * @param string $publicationNumber the publication number of the case.
     *
     * @return Response|Response\GetCaseResponse
     * @throws Exception
     */
    public function getCase(string $publicationNumber): Response\GetCaseResponse
    {
        $request = new Request\GetCase();
        $request->publicationNumber = $publicationNumber;

        return $this->process($request);
    }

    /**
     * Get insolvency case with references to its reports.
     *
     * @param string $publicationNumber the publication number of the case.
     *
     * @return Response|Response\GetCaseWithReportsResponse
     * @throws Exception
     */
    public function getCaseWithReports(string $publicationNumber): Response\GetCaseWithReportsResponse
    {
        $request = new Request\GetCaseWithReports();
        $request->publicationNumber = $publicationNumber;

        return $this->process($request);
    }

    /**
     * Get a report for an insolvency.
     *
     * @param string $reportId the report identification number.
     *
     * @return GetReportResponse
     * @throws Exception
     */
    public function getReport(string $reportId): GetReportResponse
    {
        $request = new GetReport();
        $request->reportId = $reportId;

        return $this->process($request);
    }

    /**
     * Get the date when the latest publication is added.
     *
     * @return Response|Response\GetLastUpdateResponse
     * @throws Exception
     */
    public function getLastUpdate(): Response\GetLastUpdateResponse
    {
        return $this->process(new Request\GetLastUpdate());
    }

    /**
     * Search for publications of a specific date.
     *
     * @param \DateTime $date tne date of the publications to look up.
     * @param string $court the court (number) where the publications are registered.
     * @param string|null $pubType the type of publication.
     *
     * @return Response|Response\SearchByDateResponse
     * @throws Exception
     */
    public function searchByDate(\DateTime $date, string $court, string $pubType = null): Response\SearchByDateResponse
    {
        $request = new Request\SearchByDate();
        $request->date = $date;
        $request->court = $court;
        $request->pubType = $pubType;

        return $this->process($request);
    }

    /**
     * Search for publications of the last mutated/added insolvencies for data replication.
     *
     * @param \DateTime $modifyDate the modified date since.
     *
     * @return Response|Response\SearchModifiedSinceResponse
     * @throws Exception
     */
    public function searchModifiedSince(\DateTime $modifyDate): Response\SearchModifiedSinceResponse
    {
        $request = new Request\SearchModifiedSince();
        $request->modifyDate = $modifyDate;

        return $this->process($request);
    }

    /**
     * Search for removed publications for data replication.
     *
     * @param \DateTime $modifyDate the modified date since.
     *
     * @return Response|Response\SearchRemovedSinceResponse
     * @throws Exception
     */
    public function searchRemovedSince(\DateTime $modifyDate): Response\SearchRemovedSinceResponse
    {
        $request = new Request\SearchRemovedSince();
        $request->modifyDate = $modifyDate;

        return $this->process($request);
    }

    /**
     * Search for added and modified reposts in a given time period.
     *
     * @param \DateTime $datetimeFrom the start date.
     * @param \DateTime|null $datetimeTo the end date.
     *
     * @return Response|Response\SearchReportsSinceResponse
     * @throws Exception
     */
    public function searchReportsSince(
        \DateTime $datetimeFrom,
        \DateTime $datetimeTo = null
    ): Response\SearchReportsSinceResponse {
        $request = new Request\SearchReportsSince();
        $request->datetimeFrom = $datetimeFrom;
        $request->datetimeTo = $datetimeTo ?? new \DateTime();

        return $this->process($request);
    }

    /**
     * @param string $request
     * @return SoapHandler|object
     * @internal
     */
    public function getHandler(string $request)
    {
        if (is_a($request, SoapRequest::class, true)) {
            return new SoapHandler($this->getHttpClient(), $this->serializer);
        }

        return new GetReportHandler($this->getHttpClient(false));
    }

    /**
     * Process a request.
     *
     * @param Request|GetReport $request
     *
     * @return Response|GetReportResponse
     * @throws Exception
     */
    protected function process($request)
    {
        if (!$request instanceof Request && !$request instanceof GetReport) {
            throw new \TypeError('Invalid request');
        }

        return $this->commandBus->handle($request);
    }

    /**
     * Get http client.
     *
     * @param bool $forSoap
     * @return HttpClient
     */
    protected function getHttpClient(bool $forSoap = true): HttpClient
    {
        $stack = HandlerStack::create(new CurlHandler());
        $stack->push(Middleware::mapResponse(new HttpExceptionMiddleware()));

        if ($forSoap) {
            $stack->push(Middleware::mapRequest(new SoapActionMiddleware()));
        }

        return new HttpClient([
            'base_uri' => $forSoap ? $this->config->endPoint : $this->config->documentUri,
            'handler' => $stack,
        ]);
    }
}
