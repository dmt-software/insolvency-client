<?php

namespace DMT\Test\Insolvency\Soap\Serializer;

use DMT\Insolvency\Soap\Serializer\SoapAddressingEventSubscriber;
use DMT\Soap\Serializer\SoapSerializationVisitorFactory;
use JMS\Serializer\EventDispatcher\ObjectEvent;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\XmlSerializationVisitor;
use PHPUnit\Framework\TestCase;

/**
 * Class SoapAddressingEventSubscriberTest
 */
class SoapAddressingEventSubscriberTest extends TestCase
{
    /**
     * Test soap addressing is added.
     */
    public function testAddAddressing()
    {
        $event = $this->getEvent();
        $xpath = new \DOMXPath($event->getVisitor()->getDocument());

        $this->assertCount(0, $xpath->query('//*[local-name()="Action"]'));
        $this->assertCount(0, $xpath->query('//*[local-name()="To"]'));

        $listener = new SoapAddressingEventSubscriber();
        $listener->addAddressing($event);

        $this->assertCount(1, $xpath->query('//*[local-name()="Action"]'));
        $this->assertCount(1, $xpath->query('//*[local-name()="To"]'));
    }

    /**
     * @return ObjectEvent
     */
    protected function getEvent(): ObjectEvent
    {
        /** @var XmlSerializationVisitor $visitor */
        $visitor = (new SoapSerializationVisitorFactory())->getVisitor();
        $visitor->getDocument()->firstChild->appendChild(
            $visitor->getDocument()->createElementNS('http://schemas.xmlsoap.org/soap/envelope/', 'Header')
        );
        $visitor->getCurrentNode()->appendChild($visitor->getDocument()->createElement('Dummy'));

        $context = $this->getMockBuilder(SerializationContext::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getDepth'])
            ->getMock();
        $context
            ->expects($this->once())
            ->method('getDepth')
            ->willReturn(0);

        $event = $this->getMockBuilder(ObjectEvent::class)
            ->setConstructorArgs([$context, '', []])
            ->onlyMethods(['getVisitor', 'getContext'])
            ->getMock();
        $event
            ->expects($this->any())
            ->method('getVisitor')
            ->willReturn($visitor);
        $event
            ->expects($this->once())
            ->method('getContext')
            ->willReturn($context);

        /** @var ObjectEvent $event */
        return $event;
    }
}
