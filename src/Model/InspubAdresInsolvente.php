<?php

namespace DMT\Insolvency\Model;

use JMS\Serializer\Annotation as JMS;

/**
 * Class InspubAdresInsolvente
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/inspubber01")
 * @JMS\XmlRoot("inspubAdresInsolvente", namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
 */
class InspubAdresInsolvente
{
    /**
     * @JMS\SerializedName("datumBegin")
     * @JMS\Type("DateTime<'Y-m-dP'>")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var \DateTime $datumBegin
     */
    public $datumBegin;

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
     * @JMS\Type("int")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var int $huisnummer
     */
    public $huisnummer;

    /**
     * @JMS\SerializedName("huisnummerToevoeging1")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $huisnummerToevoeging1
     */
    public $huisnummerToevoeging1;

    /**
     * @JMS\SerializedName("huisnummerToevoeging2")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $huisnummerToevoeging2
     */
    public $huisnummerToevoeging2;

    /**
     * @JMS\SerializedName("postcode")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $postcode
     */
    public $postcode;

    /**
     * @JMS\SerializedName("plaats")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $plaats
     */
    public $plaats;
}
