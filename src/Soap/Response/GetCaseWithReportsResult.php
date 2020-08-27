<?php

namespace DMT\Insolvency\Soap\Response;

use DMT\Insolvency\Model\InspubWebserviceInsolvente;
use JMS\Serializer\Annotation as JMS;

/**
 * Class GetCaseWithReportsResult
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/cir01")
 * @JMS\XmlRoot("getCaseWithReportsResult", namespace="http://www.rechtspraak.nl/namespaces/cir01")
 */
class GetCaseWithReportsResult
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
