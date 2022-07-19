<?php

namespace DMT\Insolvency\Http;

use DMT\Http\Client\RequestHandler;
use DMT\Insolvency\Config;
use DMT\Insolvency\Http\Request\GetReport;
use DMT\Insolvency\Http\Response\GetReportResponse;
use DMT\Insolvency\Http\Response\GetReportResult;
use DMT\Insolvency\Model\Document;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Psr7\Request as HttpRequest;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestFactoryInterface;

/**
 * Class GetReportHandler
 */
class GetReportHandler
{
    private Config $config;
    private RequestHandler $requestHandler;
    protected RequestFactoryInterface $requestFactory;

    /**
     * GetReportHandler constructor.
     *
     * @param RequestHandler $requestHandler
     * @param Config $config
     */
    public function __construct(
        Config $config,
        RequestHandler $requestHandler,
        RequestFactoryInterface $requestFactory
    ) {
        $this->config = $config;
        $this->requestHandler = $requestHandler;
        $this->requestFactory = $requestFactory;
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
        $request = new HttpRequest('GET', $this->config->documentUri . $request->reportId, []);

        $httpResponse = $this->requestHandler->handle($request);

        $response = new GetReportResponse();
        $response->result = new GetReportResult();
        $response->result->report = new Document();
        $response->result->report->mime = $httpResponse->getHeaderLine('Content-Type');
        $response->result->report->document = base64_encode($httpResponse->getBody()->getContents());

        return $response;
    }
}
