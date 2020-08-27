<?php

namespace DMT\Insolvency\Soap\Response;

use DMT\Insolvency\Model\LastUpdate;
use JMS\Serializer\Annotation as JMS;

/**
 * Class GetLastUpdateResult
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/cir01")
 * @JMS\XmlRoot("GetLastUpdateResult", namespace="http://www.rechtspraak.nl/namespaces/cir01")
 */
class GetLastUpdateResult
{
    /**
     * @JMS\SerializedName("lastUpdate")
     * @JMS\Type("DMT\Insolvency\Model\LastUpdate")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/updateWs")
     *
     * @var LastUpdate $lastUpdate
     */
    public $lastUpdate;
}
