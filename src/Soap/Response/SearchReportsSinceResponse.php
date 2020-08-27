<?php

namespace DMT\Insolvency\Soap\Response;

use DMT\Insolvency\Soap\Response;
use JMS\Serializer\Annotation as JMS;

/**
 * Class SearchReportsSinceResponse
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/cir01")
 * @JMS\XmlRoot("searchReportsSinceResponse", namespace="http://www.rechtspraak.nl/namespaces/cir01")
 */
class SearchReportsSinceResponse implements Response
{
    /**
     * @JMS\SerializedName("searchReportsSinceResult")
     * @JMS\Type("DMT\Insolvency\Soap\Response\searchReportsSinceResult")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/cir01")
     *
     * @var SearchReportsSinceResult $searchReportsSinceResult
     */
    public $searchReportsSinceResult;

}
