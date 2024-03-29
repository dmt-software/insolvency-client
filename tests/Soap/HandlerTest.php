<?php

namespace DMT\Test\Insolvency\Soap;

use DMT\Http\Client\RequestHandler;
use DMT\Insolvency\Client;
use DMT\Insolvency\Config;
use DMT\Insolvency\Soap\Handler;
use DMT\Insolvency\Soap\Request\GetLastUpdate;
use DMT\Insolvency\Soap\Response\GetLastUpdateResponse;
use DMT\Insolvency\Soap\Serializer\SoapSerializer;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\HttpFactory;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class HandlerTest extends TestCase
{
    /**
     * Test soap handler.
     */
    public function testHandle()
    {
        $expected = (new \DateTime())->format('Y-m-dP');
        $httpClient = new HttpClient([
            'handler' => HandlerStack::create(
                new MockHandler([new Response(200, ['Content-Type' => 'text/xml'], $this->getXmlResponse($expected))])
            )
        ]);

        /** @var Client $client */
        $reflection = new ReflectionClass(Client::class);
        $client = $reflection->newInstanceWithoutConstructor();

        $config = new Config(['user' => 'user', 'password' => 'secret123']);
        $handler = new Handler(
            $config,
            new RequestHandler($httpClient),
            new HttpFactory(),
            new SoapSerializer($client, $config)
        );
        /** @var GetLastUpdateResponse $response */
        $response = $handler->handle(new GetLastUpdate());

        $this->assertInstanceOf(GetLastUpdateResponse::class, $response);
        $this->assertEquals($expected, $response->result->lastUpdate->lastUpdateDate->format('Y-m-dP'));
    }

    protected function getXmlResponse(string $date): string
    {
        return sprintf('
            <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                <soap:Body>
                    <GetLastUpdateResponse xmlns="http://www.rechtspraak.nl/namespaces/cir01">
                        <GetLastUpdateResult>
                            <lastUpdate xmlns="http://www.rechtspraak.nl/namespaces/updateWs">
                                <lastUpdateDate>%s</lastUpdateDate>
                            </lastUpdate>
                        </GetLastUpdateResult>
                    </GetLastUpdateResponse>
                </soap:Body>
            </soap:Envelope>',
            $date
        );
    }
}
