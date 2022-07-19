<?php

namespace DMT\Test\Insolvency;

use DMT\Http\Client\RequestHandler;
use DMT\Insolvency\Client;
use DMT\Insolvency\Config;
use DMT\Insolvency\Http\GetReportHandler;
use DMT\Insolvency\Http\Middleware\ExceptionMiddleware;
use DMT\Insolvency\Http\Middleware\SoapActionMiddleware;
use DMT\Insolvency\Http\Request\GetReport;
use DMT\Insolvency\Model\BeschikbareVerslagen;
use DMT\Insolvency\Model\Document;
use DMT\Insolvency\Model\Insolvente;
use DMT\Insolvency\Model\LastUpdate;
use DMT\Insolvency\Model\PublicatieLijst;
use DMT\Insolvency\Model\VerwijderdePublicatieLijst;
use DMT\Insolvency\Soap\Handler as SoapHandler;
use DMT\Insolvency\Soap\Request as SoapRequest;
use DMT\Insolvency\Soap\Serializer\SoapSerializer;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\HttpFactory;
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
            ->setConstructorArgs([
                new Config(['user' => 'user', 'password' => 'pass']),
                new HttpClient(),
                new HttpFactory()
            ])
            ->onlyMethods(['getHandler'])
            ->getMock();

        $this->client
            ->expects($this->any())
            ->method('getHandler')
            ->willReturnCallback([$this, 'getMockHandler']);
    }

    public function testGetCase()
    {
        $this->assertInstanceOf(Insolvente::class, $this->client->getCase('16.mne.23.100.F.1300.1.00'));
    }

    public function testGetCaseWithReports()
    {
        $insolvente = $this->client->getCase('16.mne.23.100.F.1300.1.00', true);

        $this->assertInstanceOf(Insolvente::class, $insolvente);
        $this->assertInstanceOf(Document::class, $insolvente->beschikbareVerslagen->verslag[0]->report);
    }

    public function testGetReport()
    {
        $this->assertInstanceOf(Document::class, $this->client->getReport('13_ams_16_999_F_V_00'));
    }

    public function testGetLastUpdate()
    {
        $this->assertInstanceOf(LastUpdate::class, $this->client->getLastUpdate());
    }

    public function testSearchByDate()
    {
        $publicatieLijst = $this->client->searchByDate(new \DateTime('2021-04-12'), '41');

        $this->assertInstanceOf(PublicatieLijst::class, $publicatieLijst);
        $this->assertInstanceOf(Insolvente::class, $publicatieLijst->publicaties[0]->insolvente);
    }

    public function testSearchInsolvencyId()
    {
        $publicatieLijst = $this->client->searchInsolvencyId('F.01/20/293');

        $this->assertInstanceOf(PublicatieLijst::class, $publicatieLijst);
        $this->assertInstanceOf(Insolvente::class, $publicatieLijst->publicaties[0]->insolvente);
    }

    public function testSearchNaturalPerson()
    {
        $publicatieLijst = $this->client->searchNaturalPerson(new \DateTime('1970-01-01'), null, 'Do');

        $this->assertInstanceOf(PublicatieLijst::class, $publicatieLijst);
        $this->assertInstanceOf(Insolvente::class, $publicatieLijst->publicaties[0]->insolvente);
    }

    public function testSearchUndertaking()
    {
        $publicatieLijst = $this->client->searchUndertaking(null, '99098123');

        $this->assertInstanceOf(PublicatieLijst::class, $publicatieLijst);
        $this->assertInstanceOf(Insolvente::class, $publicatieLijst->publicaties[0]->insolvente);
    }

    public function testSearchModifiedSince()
    {
        $publicatieLijst = $this->client->searchModifiedSince(new \DateTime('2021-05-19'));

        $this->assertInstanceOf(PublicatieLijst::class, $publicatieLijst);
        $this->assertInstanceOf(Insolvente::class, $publicatieLijst->publicaties[0]->insolvente);
    }

    public function testSearchRemovedSince()
    {
        $this->assertInstanceOf(
            VerwijderdePublicatieLijst::class,
            $this->client->searchRemovedSince(new \DateTime('2021-05-19'))
        );
    }

    public function testSearchReportsSince()
    {
        $beschikbareVerslagen = $this->client->searchReportsSince(new \DateTime('2021-05-19'));

        $this->assertInstanceOf(BeschikbareVerslagen::class, $beschikbareVerslagen);
        $this->assertInstanceOf(Document::class, $beschikbareVerslagen->verslag[0]->report);
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
                new Config(['user' => 'user', 'password' => 'pass']),
                new RequestHandler($httpClient, new ExceptionMiddleware(), new SoapActionMiddleware()),
                new HttpFactory(),
                new SoapSerializer(
                    $this->client,
                    new Config(['user' => 'user', 'password' => 'pass'])
                )
            );
        }

        return new GetReportHandler(
            new Config(['user' => 'user', 'password' => 'pass']),
            new RequestHandler($httpClient, new ExceptionMiddleware()),
            new HttpFactory(),
        );
    }
}
