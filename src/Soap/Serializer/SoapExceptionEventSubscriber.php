<?php

namespace DMT\Insolvency\Soap\Serializer;

use DMT\Insolvency\Exception\Exception;
use DMT\Insolvency\Exception\RequestException;
use DMT\Insolvency\Exception\NotFoundException;
use DMT\Insolvency\Exception\ResponseException;
use DMT\Insolvency\Exception\UnavailableException;
use DMT\Insolvency\Soap\Response;
use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\PreDeserializeEvent;

/**
 * Class SoapExceptionEventSubscriber
 *
 * 1. No results found
 * 2. Technical error while handling the request
 * 3. To many results
 * 4. Incorrect input
 * 5. It can not be garantueed that the requested records fit correctly for synchronization purposes
 * 6. No reports from before 1 May 2010 are available
 * 7. The maximum interval between datetimeFrom and datetimeTo is one month
 */
class SoapExceptionEventSubscriber implements EventSubscriberInterface
{
    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            [
                'event' => 'serializer.pre_deserialize',
                'method' => 'toException',
                'format' => 'soap',
            ]
        ];
    }

    /**
     * @param PreDeserializeEvent $event
     * @throws Exception
     */
    public function toException(PreDeserializeEvent $event)
    {
        if (!is_a($event->getType()['name'], Response::class, true)) {
            return;
        }

        $elements = $event->getData()->xpath('//*[local-name()="exceptie"]/@errorcode');
        if (!count($elements)) {
            return;
        }

        switch ($elements[0]) {
            case 1: throw new NotFoundException('No results found');
            case 6: throw new NotFoundException('No reports from before 1 May 2010 are available');
            case 3: throw new ResponseException('To many results');
            case 5: throw new ResponseException('Synchronisation will probably fail due to expired history-file');
            case 4: throw new RequestException('Incorrect input');
            case 7: throw new RequestException('The maximum interval between datetimeFrom and datetimeTo is one month');
            default: throw new UnavailableException('Technical error while handling the request'); // includes 2
        }
    }
}
