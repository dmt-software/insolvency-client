<?php

namespace DMT\Insolvency\Soap\Response;

use DMT\Insolvency\Model\VerwijderdePublicatieLijst;
use JMS\Serializer\Annotation as JMS;

/**
 * Class SearchRemovedSinceResult
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/cir01")
 * @JMS\XmlRoot("searchRemovedSinceResult", namespace="http://www.rechtspraak.nl/namespaces/cir01")
 */
class SearchRemovedSinceResult
{
    /**
     * @JMS\SerializedName("verwijderdePublicatieLijst")
     * @JMS\Type("DMT\Insolvency\Model\VerwijderdePublicatieLijst")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var VerwijderdePublicatieLijst $verwijderdePublicatieLijst
     */
    public $verwijderdePublicatieLijst;
}
