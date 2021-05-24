<?php

namespace DMT\Test\Insolvency\Exception;

use DMT\CommandBus\Validator\ValidationException;
use DMT\Insolvency\Exception\Exception;
use DMT\Insolvency\Exception\ExceptionMiddleware;
use DMT\Insolvency\Exception\RequestException;
use DMT\Insolvency\Exception\ResponseException;
use DMT\Insolvency\Exception\UnavailableException;
use DMT\Insolvency\Soap\Request;
use GuzzleHttp\Exception\ConnectException;
use JMS\Serializer\Exception\ObjectConstructionException;
use PHPUnit\Framework\TestCase;

class ExceptionMiddlewareTest extends TestCase
{
    /**
     * @dataProvider provideException
     *
     * @param \Exception $exception
     * @param string $expected
     *
     * @throws Exception
     */
    public function testException(\Exception $exception, string $expected)
    {
        $this->expectException($expected);

        $middleware = new ExceptionMiddleware();
        $middleware->execute(new Request\GetLastUpdate(), function () use ($exception) {
            throw $exception;
        });
    }

    public function provideException(): iterable
    {
        return [
            [new ConnectException('oops', new   \GuzzleHttp\Psr7\Request('POST', '/')), UnavailableException::class],
            [new UnavailableException('passed on'), UnavailableException::class],
            [new ObjectConstructionException('can not initialize class'), UnavailableException::class],
            [new ResponseException('Not found'), ResponseException::class],
            [new ValidationException('invalid request'), RequestException::class],
        ];
    }
}
