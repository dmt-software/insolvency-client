<?php

namespace DMT\Insolvency\Soap\Serializer;

use DMT\Insolvency\Config;
use DMT\Insolvency\Model\Verslag;
use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;

/**
 * Class AddIdentificationUriEventSubscriber
 */
class AddIdentificationUriEventSubscriber implements EventSubscriberInterface
{
    /** @var Config $config */
    protected $config;

    /**
     * AddIdentificationUriEventSubscriber constructor.
     *
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }


    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            [
                'event' => 'serializer.post_deserialize',
                'method' => 'addGetReportUri',
                'format' => 'soap',
                'class' => Verslag::class,
            ]
        ];
    }

    /**
     * Add report uri.
     *
     * @param ObjectEvent $event
     */
    public function addGetReportUri(ObjectEvent $event): void
    {
        /** @var Verslag $report */
        $report = $event->getObject();

        if ($report->kenmerk) {
            $report->uri = $this->config->documentUri . $report->kenmerk;
        }
    }
}
