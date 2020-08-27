<?php

namespace DMT\Insolvency\Model;

use JMS\Serializer\Annotation as JMS;

/**
 * Class LastUpdate
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/updateWs")
 * @JMS\XmlRoot("lastUpdate", namespace="http://www.rechtspraak.nl/namespaces/updateWs")
 */
class LastUpdate
{
    /**
     * @JMS\SerializedName("lastUpdateDate")
     * @JMS\Type("DateTime<'Y-m-dP'>")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/updateWs")
     *
     * @var \DateTime $lastUpdateDate
     */
    public $lastUpdateDate;
}
