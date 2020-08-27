<?php

namespace DMT\Insolvency\Http\Middleware;

use DMT\Insolvency\Exception\AuthorizationException;
use DMT\Insolvency\Exception\NotFoundException;
use DMT\Insolvency\Exception\ResponseException;
use DMT\Insolvency\Exception\UnavailableException;
use Psr\Http\Message\ResponseInterface;

/**
 * Class ExceptionMiddleware
 */
class ExceptionMiddleware
{
    /**
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function __invoke(ResponseInterface $response): ResponseInterface
    {
        if ($response->getStatusCode() >= 500) {
            throw new UnavailableException($response->getReasonPhrase());
        }

        if ($response->getStatusCode() === 404) {
            throw new NotFoundException('No results found');
        }

        if ($response->getStatusCode() === 401) {
            throw new AuthorizationException($response->getReasonPhrase());
        }

        if ($response->getStatusCode() >= 400) {
            throw new ResponseException($response->getReasonPhrase());
        }

        return $response;
    }
}
