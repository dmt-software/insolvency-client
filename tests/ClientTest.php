<?php

namespace DMT\Test\Insolvency;

use DMT\Insolvency\Client;
use DMT\Insolvency\Config;
use DMT\Insolvency\Http\GetReportHandler;
use DMT\Insolvency\Http\Request\GetReport;
use DMT\Insolvency\Http\Response\GetReportResponse;
use DMT\Insolvency\Soap\Handler as SoapHandler;
use DMT\Insolvency\Soap\Request;
use DMT\Insolvency\Soap\Request as SoapRequest;
use DMT\Insolvency\Soap\Response;
use DMT\Insolvency\Soap\Serializer\SoapSerializer;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response as HttpResponse;
use PHPUnit\Framework\TestCase;

/**
 * Class ClientTest
 */
class ClientTest extends TestCase
{
    /** @var Client $client */
    protected $client;

    public function setUp(): void
    {
        $this->client = $this->getMockBuilder(Client::class)
            ->setConstructorArgs([new Config(['user' => 'user', 'password' => 'pass'])])
            ->onlyMethods(['getHandler'])
            ->getMock();

        $this->client
            ->expects($this->any())
            ->method('getHandler')
            ->willReturnCallback([$this, 'getMockHandler']);
    }

    public function testGetCase()
    {
        $this->assertInstanceOf(
            Response\GetCaseResponse::class,
            $this->client->getCase('16.mne.23.100.F.1300.1.00')
        );
    }

    public function testGetCaseWithReports()
    {
        $this->assertInstanceOf(
            Response\GetCaseWithReportsResponse::class,
            $this->client->getCaseWithReports('16.mne.23.100.F.1300.1.00')
        );
    }

    public function testGetReport()
    {
        $this->assertInstanceOf(
            GetReportResponse::class,
            $this->client->getReport('13_ams_16_999_F_V_00')
        );
    }

    public function testGetLastUpdate()
    {
        $this->assertInstanceOf(
            Response\GetLastUpdateResponse::class,
            $this->client->getLastUpdate()
        );
    }

    public function testSearchByDate()
    {
        $this->assertInstanceOf(
            Response\SearchByDateResponse::class,
            $this->client->searchByDate(new \DateTime('2021-04-12'), '41')
        );
    }

    public function testSearchInsolvencyId()
    {
        $this->assertInstanceOf(
            Response\SearchInsolvencyIDResponse::class,
            $this->client->searchInsolvencyId('F.01/20/293')
        );
    }

    public function testSearchNaturalPerson()
    {
        $this->assertInstanceOf(
            Response\SearchNaturalPersonResponse::class,
            $this->client->searchNaturalPerson(new \DateTime('1970-01-01'), null, 'Do')
        );
    }

    public function testSearchUndertaking()
    {
        $this->assertInstanceOf(
            Response\SearchUndertakingResponse::class,
            $this->client->searchUndertaking(null, '99098123')
        );
    }

    public function testSearchModifiedSince()
    {
        $this->assertInstanceOf(
            Response\SearchModifiedSinceResponse::class,
            $this->client->searchModifiedSince(new \DateTime('2021-05-19'))
        );
    }

    public function testSearchRemovedSince()
    {
        $this->assertInstanceOf(
            Response\SearchRemovedSinceResponse::class,
            $this->client->searchRemovedSince(new \DateTime('2021-05-19'))
        );
    }

    public function testSearchReportsSince()
    {
        $this->assertInstanceOf(
            Response\SearchReportsSinceResponse::class,
            $this->client->searchReportsSince(new \DateTime('2021-05-19'))
        );
    }

    public function testProcess()
    {
        $this->assertInstanceOf(
            Response\GetLastUpdateResponse::class,
            $this->client->process(new Request\GetLastUpdate())
        );
    }

    public function testProcessIllegalRequest()
    {
        $this->expectErrorMessage('Invalid request');

        $this->client->process(new \stdClass());
    }

    public function getMockHandler(string $request)
    {
        $file = preg_replace('~^.*\\\\([^\\\\]+)$~', '$1', $request);
        $body = file_get_contents(
            sprintf('%s/data/%s.%s', __DIR__, $file, $type = $request === GetReport::class ? 'pdf' : 'xml')
        );

        $response = new HttpResponse(200, ['Content-Type' => 'text/xml'], $body);
        if ($type === 'pdf') {
            $response = $response->withHeader('Content-Type', 'application/pdf');
        }

        $httpClient = new HttpClient([
            'handler' => HandlerStack::create(
                new MockHandler([$response])
            )
        ]);

        if (is_a($request, SoapRequest::class, true)) {
            return new SoapHandler(
                $httpClient,
                new SoapSerializer(
                    new Config(['user' => 'user', 'password' => 'pass'])
                )
            );
        }

        return new GetReportHandler($httpClient);
    }
}
