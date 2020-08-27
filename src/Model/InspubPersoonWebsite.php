<?php

namespace DMT\Insolvency\Model;

use JMS\Serializer\Annotation as JMS;

/**
 * Class InspubPersoonWebsite
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/inspubber01")
 * @JMS\XmlRoot("inspubPersoonWebsite", namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
 */
class InspubPersoonWebsite
{
    /**
     * @JMS\SerializedName("rechtspersoonlijkheid")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $rechtspersoonlijkheid
     */
    public $rechtspersoonlijkheid;

    /**
     * @JMS\SerializedName("voornaam")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $voornaam
     */
    public $voornaam;

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
     * @JMS\SerializedName("geboortedatum")
     * @JMS\Type("DateTime<'Y-m-d'>")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var \DateTime $geboortedatum
     */
    public $geboortedatum;

    /**
     * @JMS\SerializedName("geboorteplaats")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $geboorteplaats
     */
    public $geboorteplaats;

    /**
     * @JMS\SerializedName("geboorteland")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $geboorteland
     */
    public $geboorteland;

    /**
     * @JMS\SerializedName("overlijdensdatum")
     * @JMS\Type("DateTime<'Y-m-d'>")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var \DateTime $overlijdensdatum
     */
    public $overlijdensdatum;

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
}
