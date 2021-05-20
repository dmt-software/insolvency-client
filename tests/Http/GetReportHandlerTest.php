<?php

namespace DMT\Test\Insolvency\Http;

use DMT\Insolvency\Http\GetReportHandler;
use DMT\Insolvency\Http\Request\GetReport;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
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
                new MockHandler([new Response(200, ['Content-Type' => 'application/pdf'], '255044462D')])
            )
        ]);

        $handler = new GetReportHandler($client);
        $response = $handler->handle(new GetReport());

        $this->assertSame(base64_encode('255044462D'), $response->getReportResult->report->document);
        $this->assertSame('base64', $response->getReportResult->report->encoding);
        $this->assertSame('application/pdf', $response->getReportResult->report->mime);
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

        $handler = new GetReportHandler($client);
        $handler->handle(new GetReport());
    }
}
