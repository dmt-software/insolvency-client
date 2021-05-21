<?php

namespace DMT\Test\Insolvency\Soap\Serializer;

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
        $report = new Verslag();
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

        $listener = new AddIdentificationUriEventSubscriber(new Config([]));
        $listener->addGetReportUri($event);

        $this->assertStringContainsString($report->kenmerk, $report->uri);
    }
}
