<?php

namespace DMT\Insolvency\Model;

use JMS\Serializer\Annotation as JMS;

/**
 * Class InspubWebserviceInsolvente
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/inspubber01")
 * @JMS\XmlRoot("inspubWebserviceInsolvente", namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
 */
class InspubWebserviceInsolvente
{
    /**
     * @JMS\SerializedName("insolvente")
     * @JMS\Type("DMT\Insolvency\Model\Insolvente")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var Insolvente $insolvente
     */
    public $insolvente;
}
