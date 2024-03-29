<?php

namespace DMT\Test\Insolvency\Http;

use DMT\Http\Client\RequestHandler;
use DMT\Insolvency\Config;
use DMT\Insolvency\Http\GetReportHandler;
use DMT\Insolvency\Http\Request\GetReport;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\HttpFactory;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientExceptionInterface;

class GetReportHandlerTest extends TestCase
{
    /**
     * Test handler.
     */
    public function testHandle()
    {
        $client = new HttpClient([
            'handler' => HandlerStack::create(
                new MockHandler([new Response(200, ['Content-Type' => 'application/pdf'], '%PDF-')])
            )
        ]);

        $getReport = new GetReport();
        $getReport->reportId = '';

        $handler = new GetReportHandler(
            new Config(['user' => 'user', 'password' => 'pass']),
            new RequestHandler($client),
            new HttpFactory()
        );
        $response = $handler->handle($getReport);

        $this->assertSame(base64_encode('%PDF-'), $response->result->report->document);
        $this->assertSame('base64', $response->result->report->encoding);
        $this->assertSame('application/pdf', $response->result->report->mime);
    }

    /**
     * Test http client failure.
     */
    public function testHandleFailure()
    {
        $this->expectException(ClientExceptionInterface::class);

        $client = new HttpClient([
            'handler' => HandlerStack::create(
                new MockHandler([new ConnectException('Could not connect to service', new Request('GET', ''))])
            )
        ]);

        $getReport = new GetReport();
        $getReport->reportId = '';

        $handler = new GetReportHandler(
            new Config(['user' => 'user', 'password' => 'pass']),
            new RequestHandler($client),
            new HttpFactory()
        );
        $handler->handle($getReport);
    }
}
