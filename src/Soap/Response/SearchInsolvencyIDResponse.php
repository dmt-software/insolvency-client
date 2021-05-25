<?php

namespace DMT\Insolvency\Soap\Response;

use DMT\Insolvency\Soap\Response;
use JMS\Serializer\Annotation as JMS;

/**
 * Class SearchInsolvencyIDResponse
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/cir01")
 * @JMS\XmlRoot("searchInsolvencyIDResponse", namespace="http://www.rechtspraak.nl/namespaces/cir01")
 */
class SearchInsolvencyIDResponse implements Response
{
    /**
     * @JMS\SerializedName("searchInsolvencyIDResult")
     * @JMS\Type("DMT\Insolvency\Soap\Response\SearchInsolvencyIDResult")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/cir01")
     *
     * @var SearchInsolvencyIDResult $result
     */
    public $result;

}
