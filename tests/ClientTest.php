<?php

namespace DMT\Test\Insolvency;

use DMT\Insolvency\Client;
use DMT\Insolvency\Config;
use DMT\Insolvency\Http\GetReportHandler;
use DMT\Insolvency\Http\Request\GetReport;
use DMT\Insolvency\Http\Response\GetReportResponse;
use DMT\Insolvency\Model\Document;
use DMT\Insolvency\Model\Insolvente;
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
        $response = $this->client->getCaseWithReports('16.mne.23.100.F.1300.1.00');

        $this->assertInstanceOf(Response\GetCaseWithReportsResponse::class, $response);
        $this->assertInstanceOf(
            Document::class,
            $response->result->inspubWebserviceInsolvente->insolvente->beschikbareVerslagen->verslag[0]->report
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
        $response = $this->client->searchByDate(new \DateTime('2021-04-12'), '41');

        $this->assertInstanceOf(Response\SearchByDateResponse::class, $response);
        $this->assertInstanceOf(Insolvente::class, $response->result->publicatieLijst->publicaties[0]->insolvente);
    }

    public function testSearchInsolvencyId()
    {
        $response = $this->client->searchInsolvencyId('F.01/20/293');

        $this->assertInstanceOf(Response\SearchInsolvencyIDResponse::class, $response);
        $this->assertInstanceOf(Insolvente::class, $response->result->publicatieLijst->publicaties[0]->insolvente);
    }

    public function testSearchNaturalPerson()
    {
        $response = $this->client->searchNaturalPerson(new \DateTime('1970-01-01'), null, 'Do');

        $this->assertInstanceOf(Response\SearchNaturalPersonResponse::class, $response);
        $this->assertInstanceOf(Insolvente::class, $response->result->publicatieLijst->publicaties[0]->insolvente);
    }

    public function testSearchUndertaking()
    {
        $response = $this->client->searchUndertaking(null, '99098123');

        $this->assertInstanceOf(Response\SearchUndertakingResponse::class, $response);
        $this->assertInstanceOf(Insolvente::class, $response->result->publicatieLijst->publicaties[0]->insolvente);
    }

    public function testSearchModifiedSince()
    {
        $response = $this->client->searchModifiedSince(new \DateTime('2021-05-19'));

        $this->assertInstanceOf(Response\SearchModifiedSinceResponse::class, $response);
        $this->assertInstanceOf(Insolvente::class, $response->result->publicatieLijst->publicaties[0]->insolvente);
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
        $response = $this->client->searchReportsSince(new \DateTime('2021-05-19'));

        $this->assertInstanceOf(Response\SearchReportsSinceResponse::class, $response);
        $this->assertInstanceOf(Document::class, $response->result->beschikbareVerslagen->verslag[0]->report);
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
                    $this->client,
                    new Config(['user' => 'user', 'password' => 'pass'])
                )
            );
        }

        return new GetReportHandler($httpClient);
    }
}
