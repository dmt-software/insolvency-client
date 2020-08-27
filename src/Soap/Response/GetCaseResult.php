<?php

namespace DMT\Insolvency\Soap\Response;

use DMT\Insolvency\Model\InspubWebserviceInsolvente;
use JMS\Serializer\Annotation as JMS;

/**
 * Class GetCaseResult
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/cir01")
 * @JMS\XmlRoot("getCaseResult", namespace="http://www.rechtspraak.nl/namespaces/cir01")
 */
class GetCaseResult
{
    /**
     * @JMS\SerializedName("inspubWebserviceInsolvente")
     * @JMS\Type("DMT\Insolvency\Model\InspubWebserviceInsolvente")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var InspubWebserviceInsolvente
     */
    public $inspubWebserviceInsolvente;
}
