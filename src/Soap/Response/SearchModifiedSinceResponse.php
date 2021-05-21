<?php

namespace DMT\Insolvency\Soap\Response;

use DMT\Insolvency\Soap\Response;
use JMS\Serializer\Annotation as JMS;

/**
 * Class SearchModifiedSinceResponse
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/cir01")
 * @JMS\XmlRoot("searchModifiedSinceResponse", namespace="http://www.rechtspraak.nl/namespaces/cir01")
 */
class SearchModifiedSinceResponse implements Response
{
    /**
     * @JMS\SerializedName("searchModifiedSinceResult")
     * @JMS\Type("DMT\Insolvency\Soap\Response\SearchModifiedSinceResult")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/cir01")
     *
     * @var SearchModifiedSinceResult $searchModifiedSinceResult
     */
    public $searchModifiedSinceResult;

}
