<?php

namespace DMT\Test\Insolvency\Soap\Serializer;

use DMT\Insolvency\Client;
use DMT\Insolvency\Config;
use DMT\Insolvency\Model\Verslag;
use DMT\Insolvency\Soap\Serializer\AddIdentificationUriEventSubscriber;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\EventDispatcher\ObjectEvent;
use PHPUnit\Framework\TestCase;

class AddIdentificationUriEventSubscriberTest extends TestCase
{
    /**
     * Test add report uri.
     */
    public function testAddGetReportUri()
    {
        $config = new Config(['user' => 'name', 'password' => 'pass']);

        $report = new Verslag(new Client($config));
        $report->kenmerk = '12_ams_17_130_1300_01';

        $event = $this->getMockBuilder(ObjectEvent::class)
            ->setConstructorArgs([new DeserializationContext(), '', []])
            ->onlyMethods(['getObject'])
            ->getMock();

        $event
            ->expects($this->once())
            ->method('getObject')
            ->willReturn($report);

        $this->assertNull($report->uri);

        $listener = new AddIdentificationUriEventSubscriber($config);
        $listener->addGetReportUri($event);

        $this->assertStringContainsString($report->kenmerk, $report->uri);
    }
}
