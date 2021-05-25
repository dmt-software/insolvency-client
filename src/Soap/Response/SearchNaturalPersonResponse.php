<?php

namespace DMT\Insolvency\Soap\Response;

use DMT\Insolvency\Soap\Response;
use JMS\Serializer\Annotation as JMS;

/**
 * Class SearchNaturalPersonResponse
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/cir01")
 * @JMS\XmlRoot("searchNaturalPersonResponse", namespace="http://www.rechtspraak.nl/namespaces/cir01")
 */
class SearchNaturalPersonResponse implements Response
{
    /**
     * @JMS\SerializedName("searchNaturalPersonResult")
     * @JMS\Type("DMT\Insolvency\Soap\Response\SearchNaturalPersonResult")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/cir01")
     *
     * @var SearchNaturalPersonResult $result
     */
    public $result;

}
