<?php

namespace DMT\Insolvency\Soap\Response;

use DMT\Insolvency\Model\PublicatieLijst;
use JMS\Serializer\Annotation as JMS;

/**
 * Class SearchNaturalPersonResult
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/cir01")
 * @JMS\XmlRoot("searchNaturalPersonResult", namespace="http://www.rechtspraak.nl/namespaces/cir01")
 */
class SearchNaturalPersonResult
{
    /**
     * @JMS\SerializedName("publicatieLijst")
     * @JMS\Type("DMT\Insolvency\Model\PublicatieLijst")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var PublicatieLijst
     */
    public $publicatieLijst;
}
