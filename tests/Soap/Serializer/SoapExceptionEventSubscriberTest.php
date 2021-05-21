<?php

namespace DMT\Test\Insolvency\Soap\Serializer;

use DMT\Insolvency\Exception\Exception;
use DMT\Insolvency\Exception\NotFoundException;
use DMT\Insolvency\Exception\RequestException;
use DMT\Insolvency\Exception\ResponseException;
use DMT\Insolvency\Exception\UnavailableException;
use DMT\Insolvency\Soap\Response;
use DMT\Insolvency\Soap\Serializer\SoapExceptionEventSubscriber;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\EventDispatcher\PreDeserializeEvent;
use PHPUnit\Framework\TestCase;

/**
 * Class SoapExceptionEventSubscriberTest
 */
class SoapExceptionEventSubscriberTest extends TestCase
{
    /**
     * @dataProvider provideException
     *
     * @param string $code
     * @param \Exception $exception
     * @throws Exception
     */
    public function testToException(string $code, \Exception $exception)
    {
        $this->expectExceptionObject($exception);

        $event = new PreDeserializeEvent(
            new DeserializationContext(),
            new \SimpleXMLElement("<exceptie errorcode=\"{$code}\">Some message</exceptie>"),
            ['name' => Response::class, 'params' => []]
        );

        $listener = new SoapExceptionEventSubscriber();
        $listener->toException($event);
    }

    public function provideException(): iterable
    {
        return [
            ['1', new NotFoundException('No results found')],
            ['2', new UnavailableException('Technical error while handling the request')],
            ['3', new ResponseException('To many results')],
            ['4', new RequestException('Incorrect input')],
            ['5', new ResponseException('Synchronisation will probably fail due to expired history-file')],
            ['6', new NotFoundException('No reports from before 1 May 2010 are available')],
            ['7', new RequestException('The maximum interval between datetimeFrom and datetimeTo is one month')],
            'unknown error' => ['X', new UnavailableException('Technical error while handling the request')],
        ];
    }
}
