<?php

namespace DMT\Insolvency\Http\Middleware;

use DMT\Http\Client\MiddlewareInterface;
use DMT\Http\Client\RequestHandlerInterface;
use DMT\Insolvency\Exception\RequestException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use SimpleXMLElement;

/**
 * Class SoapActionMiddleware
 */
class SoapActionMiddleware implements MiddlewareInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(RequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        return $handler->handle($this->withSoapHeader($request));
    }

    /**
     * @param RequestInterface $request
     *
     * @return RequestInterface
     * @throws RequestException
     */
    private function withSoapHeader(RequestInterface $request): RequestInterface
    {
        $request->getBody()->rewind();

        $xml = new SimpleXMLElement($request->getBody()->getContents());

        $query = '//*[local-name()="Action" and namespace-uri()="http://schemas.xmlsoap.org/ws/2004/08/addressing"]';
        $elements = $xml->xpath($query);

        if (count($elements) === 0) {
            throw new RequestException(
                'Malformed request, missing {http://schemas.xmlsoap.org/ws/2004/08/addressing}Action'
            );
        }

        return $request
            ->withAddedHeader('SOAPAction', strval($elements[0]))
            ->withAddedHeader('Content-Type', 'text/xml; charset=utf-8');
    }
}