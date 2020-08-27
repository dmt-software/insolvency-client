<?php

namespace DMT\Insolvency\Soap\Response;

use DMT\Insolvency\Model\BeschikbareVerslagen;
use JMS\Serializer\Annotation as JMS;

/**
 * Class SearchReportsSinceResult
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/cir01")
 * @JMS\XmlRoot("searchReportsSinceResult", namespace="http://www.rechtspraak.nl/namespaces/cir01")
 */
class SearchReportsSinceResult
{
    /**
     * @JMS\SerializedName("beschikbareVerslagen")
     * @JMS\Type("DMT\Insolvency\Model\BeschikbareVerslagen")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var BeschikbareVerslagen $beschikbareVerslagen
     */
    public $beschikbareVerslagen;
}
