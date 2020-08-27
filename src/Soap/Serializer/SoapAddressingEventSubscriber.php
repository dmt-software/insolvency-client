<?php

namespace DMT\Insolvency\Soap\Serializer;

use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\XmlSerializationVisitor;

/**
 * Class SoapAddressingEventSubscriber
 */
class SoapAddressingEventSubscriber implements EventSubscriberInterface
{
    /** @var string $action */
    protected $action = 'http://www.rechtspraak.nl/namespaces/cir01/%s';

    /** @var string $endPoint */
    protected $endPoint = 'https://webservice.rechtspraak.nl/cir.asmx';

    /**
     * SoapAddressingEventSubscriber constructor.
     * @param string|null $action
     * @param string|null $endPoint
     */
    public function __construct(string $action = null, string $endPoint = null)
    {
        if ($action) {
            $this->action = $action;
        }
        if ($endPoint) {
            $this->endPoint = $endPoint;
        }
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            [
                'event' => 'serializer.post_serialize',
                'method' => 'addAddressing',
                'format' => 'soap',
            ]
        ];
    }

    /**
     * @param ObjectEvent $event
     */
    public function addAddressing(ObjectEvent $event)
    {
        /** @var SerializationContext $context */
        $context = $event->getContext();
        /** @var XmlSerializationVisitor $visitor */
        $visitor = $event->getVisitor();

        $document = $visitor->getDocument();
        $xpath = new \DOMXPath($document);
        $query = '//*[local-name()="Action" and namespace-uri()="http://schemas.xmlsoap.org/ws/2004/08/addressing"]';
        $namespace = $document->lookupNamespaceUri('soap');

        if (
            $context->getDepth() > 0
            || $document->getElementsByTagNameNS($namespace, 'Body')->length == 0
            || $document->getElementsByTagNameNS($namespace, 'Header')->length == 0
            || $xpath->query($query)->length > 0
        ) {
            return;
        }

        $action = sprintf(
            $this->action,
            $document->getElementsByTagNameNS($namespace, 'Body')[0]->firstChild->localName
        );

        /** @var \DOMElement $element */
        $element = $document->getElementsByTagNameNS($namespace, 'Header')[0];
        $element->appendChild(
            $document->createElementNS('http://schemas.xmlsoap.org/ws/2004/08/addressing', 'Action', $action)
        );
        $element->appendChild(
            $document->createElementNS('http://schemas.xmlsoap.org/ws/2004/08/addressing', 'To', $this->endPoint)
        );
    }
}