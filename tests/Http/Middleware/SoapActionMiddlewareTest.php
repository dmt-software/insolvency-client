<?php

namespace DMT\Test\Insolvency\Http\Middleware;

use DMT\Http\Client\RequestHandler;
use DMT\Insolvency\Exception\RequestException;
use DMT\Insolvency\Http\Middleware\SoapActionMiddleware;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use SimpleXMLElement;

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
        $stack = HandlerStack::create(
            new MockHandler([
                new Response()
            ])
        );
        $container = [];
        $stack->push(Middleware::history($container));

        $handler = new RequestHandler(
            new Client([
                'handler' => $stack
            ])
        );

        $envelope = new SimpleXMLElement('<soap:Envelope 
            xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"
            xmlns:wsa="http://schemas.xmlsoap.org/ws/2004/08/addressing"></soap:Envelope>'
        );
        $header = $envelope->addChild('Header', null, 'http://schemas.xmlsoap.org/soap/envelope/');
        $header->addChild('Action', 'TheSoapActionForRequest', 'http://schemas.xmlsoap.org/ws/2004/08/addressing');

        $request = new Request('POST', '', ['Content-Type' => 'text/xml; charset=utf-8'], $envelope->asXML());

        $middleware = new SoapActionMiddleware();
        $middleware->process($request, $handler);

        $this->assertEmpty($request->getHeaderLine('SOAPAction'));
        $this->assertSame('TheSoapActionForRequest', $container[0]['request']->getHeaderLine('SOAPAction'));
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

        $handler = new RequestHandler($this->getMockForAbstractClass(ClientInterface::class));

        $middleware = new SoapActionMiddleware();

        $middleware->process($request, $handler);
    }
}
