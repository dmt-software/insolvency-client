<?php

namespace DMT\Insolvency\Soap\Response;

use DMT\Insolvency\Model\PublicatieLijst;
use JMS\Serializer\Annotation as JMS;

/**
 * Class SearchByDateResult
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/cir01")
 * @JMS\XmlRoot("searchByDateResult", namespace="http://www.rechtspraak.nl/namespaces/cir01")
 */
class SearchByDateResult
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
