<?php

namespace DMT\Insolvency\Model;

use JMS\Serializer\Annotation as JMS;

/**
 * Class InspubPublicatiegeschiedenis
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/inspubber01")
 * @JMS\XmlRoot("inspubPublicatiegeschiedenis", namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
 */
class InspubPublicatiegeschiedenis
{
    /**
     * @JMS\Type("array<DMT\Insolvency\Model\Publicatie>")
     * @JMS\XmlList(inline=true, entry="publicatie", namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var Publicatie[] $publicatie
     */
    public $publicatie;

    /**
     * @JMS\SerializedName("instroomLegacy")
     * @JMS\Type("bool")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var bool $instroomLegacy
     */
    public $instroomLegacy;
}
