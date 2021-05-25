<?php

namespace DMT\Insolvency\Soap\Response;

use DMT\Insolvency\Soap\Response;
use JMS\Serializer\Annotation as JMS;

/**
 * Class SearchUndertakingResponse
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/cir01")
 * @JMS\XmlRoot("searchUndertakingResponse", namespace="http://www.rechtspraak.nl/namespaces/cir01")
 */
class SearchUndertakingResponse implements Response
{
    /**
     * @JMS\SerializedName("searchUndertakingResult")
     * @JMS\Type("DMT\Insolvency\Soap\Response\SearchUndertakingResult")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/cir01")
     *
     * @var SearchUndertakingResult $result
     */
    public $result;

}
