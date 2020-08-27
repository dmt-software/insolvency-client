<?php

namespace DMT\Insolvency\Soap\Response;

use DMT\Insolvency\Soap\Response;
use JMS\Serializer\Annotation as JMS;

/**
 * Class SearchRemovedSinceResponse
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/cir01")
 * @JMS\XmlRoot("searchRemovedSinceResponse", namespace="http://www.rechtspraak.nl/namespaces/cir01")
 */
class SearchRemovedSinceResponse implements Response
{
    /**
     * @JMS\SerializedName("searchRemovedSinceResult")
     * @JMS\Type("DMT\Insolvency\Soap\Response\SearchRemovedSinceResult")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/cir01")
     *
     * @var SearchRemovedSinceResult $searchRemovedSinceResult
     */
    public $searchRemovedSinceResult;
}
