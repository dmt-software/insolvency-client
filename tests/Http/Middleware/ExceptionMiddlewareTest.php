<?php

namespace DMT\Test\Insolvency\Http\Middleware;

use DMT\Http\Client\RequestHandler;
use DMT\Insolvency\Exception\AuthorizationException;
use DMT\Insolvency\Exception\NotFoundException;
use DMT\Insolvency\Exception\ResponseException;
use DMT\Insolvency\Exception\UnavailableException;
use DMT\Insolvency\Http\Middleware\ExceptionMiddleware;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * Class ExceptionMiddlewareTest
 */
class ExceptionMiddlewareTest extends TestCase
{
    /**
     * Tests expected 200 OK response.
     */
    public function testPassAlongValidResponse()
    {
        $response = new Response();

        $middleware = new ExceptionMiddleware();

        $handler = new RequestHandler(
            new Client([
                'handler' => HandlerStack::create(
                    new MockHandler([
                        $response
                    ])
                )
            ])
        );

        $this->assertSame($response, $middleware->process(new Request('GET', '/'), $handler));
    }

    /**
     * @dataProvider provideResponse
     *
     * @param Response $response
     * @param \Exception $exception
     */
    public function testThrowException(Response $response, \Exception $exception)
    {
        $this->expectExceptionObject($exception);

        $middleware = new ExceptionMiddleware();

        $handler = new RequestHandler(
            new Client([
                'handler' => HandlerStack::create(
                    new MockHandler([
                        $response
                    ])
                )
            ])
        );

        $middleware->process(new Request('GET', '/'), $handler);
    }

    /**
     * @return iterable
     */
    public function provideResponse(): iterable
    {
        $response = new Response();

        return [
            [$response->withStatus(500, 'Internal Server Error'), new UnavailableException('Internal Server Error')],
            [$response->withStatus(504, 'Gateway Timeout'), new UnavailableException('Gateway Timeout')],
            [$response->withStatus(404, 'Page Not Found'), new NotFoundException('No results found')],
            [$response->withStatus(429, 'Too Many Requests'), new ResponseException('Too Many Requests')],
            [$response->withStatus(401, 'Unauthorized'), new AuthorizationException('Unauthorized')],
        ];
    }
}
