<?php

namespace DMT\Insolvency\Soap\Response;

use DMT\Insolvency\Soap\Response;
use JMS\Serializer\Annotation as JMS;

/**
 * Class SearchByDateResponse
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/cir01")
 * @JMS\XmlRoot("searchByDateResponse", namespace="http://www.rechtspraak.nl/namespaces/cir01")
 */
class SearchByDateResponse implements Response
{
    /**
     * @JMS\SerializedName("searchByDateResult")
     * @JMS\Type("DMT\Insolvency\Soap\Response\SearchByDateResult")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/cir01")
     *
     * @var SearchByDateResult $result
     */
    public $result;

}
