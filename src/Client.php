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
        $this->serializer = $serializer;

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
     * @param Request\SearchInsolvencyID $request
     * @return Response\SearchInsolvencyIDResponse
     * @throws Exception
     */
    public function searchInsolvencyId(Request\SearchInsolvencyID $request): Response\SearchInsolvencyIDResponse
    {
        return $this->commandBus->handle($request);
    }

    /**
     * Search for publications for a person.
     *
     * @param Request\SearchNaturalPerson $request
     * @return Response\SearchNaturalPersonResponse
     * @throws Exception
     */
    public function searchNaturalPerson(Request\SearchNaturalPerson $request): Response\SearchNaturalPersonResponse
    {
        return $this->commandBus->handle($request);
    }

    /**
     * Search for publications of an undertaking.
     *
     * @param Request\SearchUndertaking $request
     * @return Response\SearchUndertakingResponse
     * @throws Exception
     */
    public function searchUndertaking(Request\SearchUndertaking $request): Response\SearchUndertakingResponse
    {
        return $this->commandBus->handle($request);
    }

    /**
     * Get insolvency case.
     *
     * @param Request\GetCase $request
     * @return Response\GetCaseResponse
     * @throws Exception
     */
    public function getCase(Request\GetCase $request): Response\GetCaseResponse
    {
        return $this->commandBus->handle($request);
    }

    /**
     * Get insolvency case with references to its reports.
     *
     * @param Request\GetCaseWithReports $request
     * @return Response\GetCaseWithReportsResponse
     * @throws Exception
     */
    public function getCaseWithReports(Request\GetCaseWithReports $request): Response\GetCaseWithReportsResponse
    {
        return $this->commandBus->handle($request);
    }

    /**
     * Get a report for an insolvency.
     *
     * @param GetReport $request
     * @return GetReportResponse
     * @throws Exception
     */
    public function getReport(GetReport $request): GetReportResponse
    {
        return $this->commandBus->handle($request);
    }

    /**
     * Get the date when the latest publication is added.
     *
     * @param Request\GetLastUpdate $request
     * @return Response\GetLastUpdateResponse
     * @throws Exception
     */
    public function getLastUpdate(Request\GetLastUpdate $request): Response\GetLastUpdateResponse
    {
        return $this->commandBus->handle($request);
    }

    /**
     * Search for publications of a specific date.
     *
     * @param Request\SearchByDate $request
     * @return Response\SearchByDateResponse
     * @throws Exception
     */
    public function searchByDate(Request\SearchByDate $request): Response\SearchByDateResponse
    {
        return $this->commandBus->handle($request);
    }

    /**
     * Search for publications of the last mutated/added insolvencies for data replication.
     *
     * @param Request\SearchModifiedSince $request
     * @return Response\SearchModifiedSinceResponse
     * @throws Exception
     */
    public function searchModifiedSince(Request\SearchModifiedSince $request): Response\SearchModifiedSinceResponse
    {
        return $this->commandBus->handle($request);
    }

    /**
     * Search for removed publications for data replication.
     *
     * @param Request\SearchRemovedSince $request
     * @return Response\SearchRemovedSinceResponse
     * @throws Exception
     */
    public function searchRemovedSince(Request\SearchRemovedSince $request): Response\SearchRemovedSinceResponse
    {
        return $this->commandBus->handle($request);
    }

    /**
     * Search for added and modified reposts in a given time period.
     *
     * @param Request\SearchReportsSince $request
     * @return Response\SearchReportsSinceResponse
     * @throws Exception
     */
    public function searchReportsSince(Request\SearchReportsSince $request): Response\SearchReportsSinceResponse
    {
        return $this->commandBus->handle($request);
    }

    /**
     * @param string $request
     * @return SoapHandler|object
     * @internal
     */
    public function getHandler(string $request)
    {
        $stack = HandlerStack::create(new CurlHandler());
        $stack->push(Middleware::mapResponse(new HttpExceptionMiddleware()));

        if (is_a($request, SoapRequest::class, true)) {
            $stack->push(Middleware::mapRequest(new SoapActionMiddleware()));

            $client = new HttpClient([
                'base_uri' => $this->config->endPoint,
                'handler' => $stack,
            ]);

            return new SoapHandler($client, new SoapSerializer($this->config));
        }

        $client = new HttpClient([
            'base_uri' => $this->config->documentUri,
            'handler' => $stack,
        ]);

        return new GetReportHandler($client);
    }
}
