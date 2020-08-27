<?php

namespace DMT\Insolvency\Soap\Response;

use DMT\Insolvency\Model\PublicatieLijst;
use JMS\Serializer\Annotation as JMS;

/**
 * Class SearchModifiedSinceResult
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/cir01")
 * @JMS\XmlRoot("searchModifiedSinceResult", namespace="http://www.rechtspraak.nl/namespaces/cir01")
 */
class SearchModifiedSinceResult
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
