<?php

namespace DMT\Insolvency\Http;

use DMT\Insolvency\Config;
use DMT\Insolvency\Exception\Exception;
use DMT\Insolvency\Http\Middleware\ExceptionMiddleware;
use DMT\Insolvency\Http\Request\GetReport;
use DMT\Insolvency\Http\Response\GetReportResponse;
use DMT\Insolvency\Http\Response\GetReportResult;
use DMT\Insolvency\Model\Document;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request as HttpRequest;
use Psr\Http\Client\ClientExceptionInterface;

/**
 * Class GetReportHandler
 */
class GetReportHandler
{
    /** @var Config $config */
    protected $config;

    /** @var HttpClient|null $httpClient */
    protected $httpClient;

    /**
     * GetReportHandler constructor.
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;

        $stack = HandlerStack::create(new CurlHandler());
        $stack->push(Middleware::mapResponse(new ExceptionMiddleware()));
        $this->httpClient = new HttpClient([
            'base_uri' => $config->documentUri,
            'handler' => $stack,
        ]);
    }

    /**
     * Handle http request.
     *
     * @param GetReport $request
     * @return GetReportResponse
     * @throws Exception
     * @throws ClientExceptionInterface
     */
    public function handle(GetReport $request): GetReportResponse
    {
        $httpResponse = $this->httpClient->sendRequest(new HttpRequest('GET', $request->reportId, []));

        $response = new GetReportResponse();
        $response->getReportResult = new GetReportResult();
        $response->getReportResult->report = new Document();
        $response->getReportResult->report->mime = $httpResponse->getHeaderLine('Content-Type');
        $response->getReportResult->report->document = base64_encode($httpResponse->getBody()->getContents());

        return $response;
    }
}
