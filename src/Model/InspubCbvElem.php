<?php

namespace DMT\Insolvency\Model;

use JMS\Serializer\Annotation as JMS;

/**
 * Class InspubCbvElem
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/inspubber01")
 * @JMS\XmlRoot("inspubCbvElem", namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
 */
class InspubCbvElem
{
    /**
     * @JMS\SerializedName("datumBegin")
     * @JMS\Type("DateTime<'Y-m-d'>")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var \DateTime $datumBegin
     */
    public $datumBegin;

    /**
     * @JMS\SerializedName("datumEind")
     * @JMS\Type("DateTime<'Y-m-d'>")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var \DateTime $datumEind
     */
    public $datumEind;

    /**
     * @JMS\SerializedName("titulatuur")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $titulatuur
     */
    public $titulatuur;

    /**
     * @JMS\SerializedName("voorletters")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $voorletters
     */
    public $voorletters;

    /**
     * @JMS\SerializedName("voorvoegsel")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $voorvoegsel
     */
    public $voorvoegsel;

    /**
     * @JMS\SerializedName("achternaam")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $achternaam
     */
    public $achternaam;

    /**
     * @JMS\SerializedName("CB")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $cB
     */
    public $cB;

    /**
     * @JMS\SerializedName("adres")
     * @JMS\Type("DMT\Insolvency\Model\InspubAdresCBElem")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var InspubAdresCBElem $adres
     */
    public $adres;
}
