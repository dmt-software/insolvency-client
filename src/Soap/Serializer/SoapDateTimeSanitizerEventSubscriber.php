<?php

namespace DMT\Insolvency\Soap\Serializer;

use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\PreDeserializeEvent;
use JMS\Serializer\Exception\RuntimeException;

/**
 * Class SoapDateTimeSanitizerEventSubscriber
 */
class SoapDateTimeSanitizerEventSubscriber implements EventSubscriberInterface
{
    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            [
                'event' => 'serializer.pre_deserialize',
                'method' => 'sanitizeDateTime',
                'format' => 'soap',
            ]
        ];
    }

    /**
     * Fix the datetime format, before it is deserialized.
     *
     * @param PreDeserializeEvent $event
     * @throws RuntimeException
     */
    public function sanitizeDateTime(PreDeserializeEvent $event)
    {
        if ($event->getType()['name'] !== 'DateTime' || empty($event->getData())) {
            return;
        }

        try {
            $dateTime = new \DateTime($event->getData()[0]);

            $element = simplexml_load_string(
                sprintf('<x attr="%s"/>', $dateTime->format($event->getType()['params'][0]))
            );

            $event->setData($element->attributes()['attr']);
        } catch (\Exception $exception) {
            throw new RuntimeException(sprintf('"%s" is not a datetime', $event->getData()[0]));
        }
    }
}