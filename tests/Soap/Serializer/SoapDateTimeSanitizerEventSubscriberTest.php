<?php

namespace DMT\Test\Insolvency\Soap\Serializer;

use DMT\Insolvency\Soap\Serializer\SoapDateTimeSanitizerEventSubscriber;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\EventDispatcher\PreDeserializeEvent;
use PHPUnit\Framework\TestCase;

/**
 * Class SoapDateTimeSanitizerEventSubscriberTest
 */
class SoapDateTimeSanitizerEventSubscriberTest extends TestCase
{
    /**
     * @dataProvider provideDateTime
     *
     * @param string $date
     * @param string $format
     * @param string $expected
     */
    public function testSanitizeDateTime(string $date, string $format, string $expected)
    {
        $event = new PreDeserializeEvent(
            new DeserializationContext(),
            new \SimpleXMLElement("<date>{$date}</date>"),
            ['name' =>'DateTime', 'params' => [$format]]
        );

        $this->assertSame($date, (string)$event->getData());

        $listener = new SoapDateTimeSanitizerEventSubscriber();
        $listener->sanitizeDateTime($event);

        $this->assertSame($expected, (string)$event->getData());
    }

    public function provideDateTime(): iterable
    {
        return [
            ["1975-1-5", "Y-m-d\TH:i:sP", "1975-01-05T00:00:00+01:00"],
            ["1982-09-25T09:20:00+01:00", "Y-m-d", "1982-09-25"],
        ];
    }
}
