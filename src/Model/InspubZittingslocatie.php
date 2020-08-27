<?php

namespace DMT\Insolvency\Model;

use JMS\Serializer\Annotation as JMS;

/**
 * Class InspubZittingslocatie
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/inspubber01")
 * @JMS\XmlRoot("inspubZittingslocatie", namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
 */
class InspubZittingslocatie
{
    /**
     * @JMS\SerializedName("straat")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $straat
     */
    public $straat;

    /**
     * @JMS\SerializedName("huisnummer")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $huisnummer
     */
    public $huisnummer;

    /**
     * @JMS\SerializedName("huisnummerToevoeging")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $huisnummerToevoeging
     */
    public $huisnummerToevoeging;

    /**
     * @JMS\SerializedName("plaats")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $plaats
     */
    public $plaats;
}
