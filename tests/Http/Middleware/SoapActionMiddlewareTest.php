<?php

namespace DMT\Test\Insolvency\Http\Middleware;

use DMT\Insolvency\Exception\RequestException;
use DMT\Insolvency\Http\Middleware\SoapActionMiddleware;
use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\TestCase;

/**
 * Class SoapActionMiddlewareTest
 */
class SoapActionMiddlewareTest extends TestCase
{
    /**
     * Test adding SOAPAction from wsa.Action.
     */
    public function testSetSoapAction()
    {
        $envelope = new \SimpleXMLElement('<soap:Envelope 
            xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"
            xmlns:wsa="http://schemas.xmlsoap.org/ws/2004/08/addressing"></soap:Envelope>'
        );
        $header = $envelope->addChild('Header', null, 'http://schemas.xmlsoap.org/soap/envelope/');
        $header->addChild('Action', 'TheSoapActionForRequest', 'http://schemas.xmlsoap.org/ws/2004/08/addressing');

        $request = new Request('POST', '', ['Content-Type' => 'text/xml; charset=utf-8'], $envelope->asXML());
        $middleware = new SoapActionMiddleware();

        $this->assertEmpty($request->getHeaderLine('SOAPAction'));
        $this->assertSame('TheSoapActionForRequest', $middleware($request)->getHeaderLine('SOAPAction'));
    }

    /**
     * Test malformed request can not add SOAPAction.
     */
    public function testSetSoapActionFails()
    {
        $this->expectExceptionObject(
            new RequestException(
                'Malformed request, missing {http://schemas.xmlsoap.org/ws/2004/08/addressing}Action'
            )
        );

        $xml = '<soap:Envelope 
                    xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"
                    xmlns:wsa="http://schemas.xmlsoap.org/ws/2004/08/addressing">
                    <soap:Header/>
                </soap:Envelope>';

        $request = new Request('POST', '', ['Content-Type' => 'text/xml; charset=utf-8'], $xml);
        $middleware = new SoapActionMiddleware();
        $middleware($request);
    }
}
