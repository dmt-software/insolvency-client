<?php

namespace DMT\Insolvency\Model;

use JMS\Serializer\Annotation as JMS;

/**
 * Class InspubHandelendOnderDeNaamElem
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/inspubber01")
 * @JMS\XmlRoot("inspubHandelendOnderDeNaamElem", namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
 */
class InspubHandelendOnderDeNaamElem
{
    /**
     * @JMS\SerializedName("handelsnaam")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $handelsnaam
     */
    public $handelsnaam;

    /**
     * @JMS\SerializedName("KvKNummer")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $kvKNummer
     */
    public $kvKNummer;

    /**
     * @JMS\SerializedName("KvKPlaats")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $kvKPlaats
     */
    public $kvKPlaats;

    /**
     * @JMS\SerializedName("handelsadressen")
     * @JMS\Type("DMT\Insolvency\Model\Handelsadressen")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var Handelsadressen $handelsadressen
     */
    public $handelsadressen;
}
