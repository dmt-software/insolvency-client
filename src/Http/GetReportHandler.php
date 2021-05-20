<?php

namespace DMT\Insolvency\Http;

use DMT\Insolvency\Http\Request\GetReport;
use DMT\Insolvency\Http\Response\GetReportResponse;
use DMT\Insolvency\Http\Response\GetReportResult;
use DMT\Insolvency\Model\Document;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Psr7\Request as HttpRequest;
use Psr\Http\Client\ClientExceptionInterface;

/**
 * Class GetReportHandler
 */
class GetReportHandler
{
    /** @var HttpClient|null $httpClient */
    protected $httpClient;

    /**
     * GetReportHandler constructor.
     * @param HttpClient $httpClient
     */
    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Handle http request.
     *
     * @param GetReport $request
     * @return GetReportResponse
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
