<?php

namespace DMT\Test\Insolvency;

use DateTime;
use DMT\Insolvency\Client;
use DMT\Insolvency\Config;
use DMT\Insolvency\Model\BeschikbareVerslagen;
use DMT\Insolvency\Model\Document;
use DMT\Insolvency\Model\Insolvente;
use DMT\Insolvency\Model\LastUpdate;
use DMT\Insolvency\Model\PublicatieLijst;
use DMT\Insolvency\Model\VerwijderdePublicatieLijst;
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
    public function getClient(...$responses): Client
    {
        $responses = array_map(
            function ($filePath) {
                return new HttpResponse(200, ['Content-Type' => 'text/xml'], file_get_contents($filePath));
            },
            $responses
        );

        return new Client(
            new Config(['user' => 'user', 'password' => 'pass']),
            new HttpClient([
                'handler' => HandlerStack::create(
                    new MockHandler($responses)
                )
            ]),
            new HttpFactory()
        );
    }

    public function testGetCase()
    {
        $client = $this->getClient(__DIR__ . '/data/GetCase.xml');

        $this->assertInstanceOf(Insolvente::class, $client->getCase('16.mne.23.100.F.1300.1.00'));
    }

    public function testGetCaseWithReports()
    {
        $client = $this->getClient(__DIR__ . '/data/GetCaseWithReports.xml', __DIR__ . '/data/GetReport.pdf');

        $this->assertInstanceOf(Insolvente::class, $insolvente = $client->getCase('16.mne.23.100.F.1300.1.00', true));
        $this->assertInstanceOf(Document::class, $insolvente->beschikbareVerslagen->verslag[0]->report);
    }

    public function testGetReport()
    {
        $client = $this->getClient(__DIR__ . '/data/GetReport.pdf');

        $this->assertInstanceOf(Document::class, $client->getReport('13_ams_16_999_F_V_00'));
    }

    public function testGetLastUpdate()
    {
        $client = $this->getClient(__DIR__ . '/data/GetLastUpdate.xml');

        $this->assertInstanceOf(LastUpdate::class, $client->getLastUpdate());
    }

    public function testSearchByDate()
    {
        $client = $this->getClient(__DIR__ . '/data/SearchByDate.xml', __DIR__ . '/data/GetCaseWithReports.xml');

        $publicatieLijst = $client->searchByDate(new DateTime('2021-04-12'), '41');

        $this->assertInstanceOf(PublicatieLijst::class, $publicatieLijst);
        $this->assertInstanceOf(Insolvente::class, $publicatieLijst->publicaties[0]->insolvente);
    }

    public function testSearchInsolvencyId()
    {
        $client = $this->getClient(__DIR__ . '/data/SearchInsolvencyID.xml', __DIR__ . '/data/GetCaseWithReports.xml');

        $this->assertInstanceOf(PublicatieLijst::class, $publicatieLijst = $client->searchInsolvencyId('F.01/20/293'));
        $this->assertInstanceOf(Insolvente::class, $publicatieLijst->publicaties[0]->insolvente);
    }

    public function testSearchNaturalPerson()
    {
        $client = $this->getClient(__DIR__ . '/data/SearchNaturalPerson.xml', __DIR__ . '/data/GetCaseWithReports.xml');

        $publicatieLijst = $client->searchNaturalPerson(new DateTime('1970-01-01'), null, 'Do');

        $this->assertInstanceOf(PublicatieLijst::class, $publicatieLijst);
        $this->assertInstanceOf(Insolvente::class, $publicatieLijst->publicaties[0]->insolvente);
    }

    public function testSearchUndertaking()
    {
        $client = $this->getClient(__DIR__ . '/data/SearchUndertaking.xml', __DIR__ . '/data/GetCaseWithReports.xml');

        $publicatieLijst = $client->searchUndertaking(null, '99098123');

        $this->assertInstanceOf(PublicatieLijst::class, $publicatieLijst);
        $this->assertInstanceOf(Insolvente::class, $publicatieLijst->publicaties[0]->insolvente);
    }

    public function testSearchModifiedSince()
    {
        $client = $this->getClient(__DIR__ . '/data/SearchModifiedSince.xml', __DIR__ . '/data/GetCaseWithReports.xml');

        $publicatieLijst = $client->searchModifiedSince(new DateTime('2021-05-19'));

        $this->assertInstanceOf(PublicatieLijst::class, $publicatieLijst);
        $this->assertInstanceOf(Insolvente::class, $publicatieLijst->publicaties[0]->insolvente);
    }

    public function testSearchRemovedSince()
    {
        $client = $this->getClient(__DIR__ . '/data/SearchRemovedSince.xml');

        $this->assertInstanceOf(
            VerwijderdePublicatieLijst::class,
            $client->searchRemovedSince(new DateTime('2021-05-19'))
        );
    }

    public function testSearchReportsSince()
    {
        $client = $this->getClient(__DIR__ . '/data/SearchReportsSince.xml', __DIR__ . '/data/GetCaseWithReports.xml');

        $beschikbareVerslagen = $client->searchReportsSince(new DateTime('2021-05-19'));

        $this->assertInstanceOf(BeschikbareVerslagen::class, $beschikbareVerslagen);
        $this->assertInstanceOf(Document::class, $beschikbareVerslagen->verslag[0]->report);
    }
}
