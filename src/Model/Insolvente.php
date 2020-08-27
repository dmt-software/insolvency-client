<?php

namespace DMT\Insolvency\Model;

use JMS\Serializer\Annotation as JMS;

/**
 * Class Insolvente
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/inspubber01")
 * @JMS\XmlRoot("insolvente", namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
 */
class Insolvente
{
    /**
     * @JMS\SerializedName("ssrNummer")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $ssrNummer
     */
    public $ssrNummer;

    /**
     * @JMS\SerializedName("preHGKInsolventieNummer")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $preHGKInsolventieNummer
     */
    public $preHGKInsolventieNummer;

    /**
     * @JMS\SerializedName("insolventienummer")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $insolventienummer
     */
    public $insolventienummer;

    /**
     * @JMS\SerializedName("behandelendeInstantieCode")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $behandelendeInstantieCode
     */
    public $behandelendeInstantieCode;

    /**
     * @JMS\SerializedName("behandelendeInstantieNaam")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $behandelendeInstantieNaam
     */
    public $behandelendeInstantieNaam;

    /**
     * @JMS\SerializedName("behandelendeVestigingCode")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $behandelendeVestigingCode
     */
    public $behandelendeVestigingCode;

    /**
     * @JMS\SerializedName("behandelendeVestigingNaam")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $behandelendeVestigingNaam
     */
    public $behandelendeVestigingNaam;

    /**
     * @JMS\SerializedName("isPreHGKGepubliceerd")
     * @JMS\Type("bool")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var bool $isPreHGKGepubliceerd
     */
    public $isPreHGKGepubliceerd;

    /**
     * @JMS\SerializedName("persoon")
     * @JMS\Type("DMT\Insolvency\Model\InspubPersoonWebsite")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var InspubPersoonWebsite $persoon
     */
    public $persoon;

    /**
     * @JMS\SerializedName("RC")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $rC
     */
    public $rC;

    /**
     * @JMS\SerializedName("VorigeRC")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $vorigeRC
     */
    public $vorigeRC;

    /**
     * @JMS\SerializedName("vorigInsolventienummer")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $vorigInsolventienummer
     */
    public $vorigInsolventienummer;

    /**
     * @JMS\SerializedName("adressen")
     * @JMS\Type("DMT\Insolvency\Model\Adressen")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var Adressen $adressen
     */
    public $adressen;

    /**
     * @JMS\SerializedName("handelendOnderDeNamen")
     * @JMS\Type("DMT\Insolvency\Model\HandelendOnderDeNamen")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var HandelendOnderDeNamen $handelendOnderDeNamen
     */
    public $handelendOnderDeNamen;

    /**
     * @JMS\SerializedName("cbvers")
     * @JMS\Type("DMT\Insolvency\Model\InspubCbvers")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var InspubCbvers $cbvers
     */
    public $cbvers;

    /**
     * @JMS\SerializedName("publicatiegeschiedenis")
     * @JMS\Type("DMT\Insolvency\Model\InspubPublicatiegeschiedenis")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var InspubPublicatiegeschiedenis $publicatiegeschiedenis
     */
    public $publicatiegeschiedenis;

    /**
     * @JMS\SerializedName("beschikbareVerslagen")
     * @JMS\Type("DMT\Insolvency\Model\BeschikbareVerslagen")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var BeschikbareVerslagen $beschikbareVerslagen
     */
    public $beschikbareVerslagen;

    /**
     * @JMS\SerializedName("eindeVindbaarheid")
     * @JMS\Type("DateTime<'Y-m-d'>")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var \DateTime $eindeVindbaarheid
     */
    public $eindeVindbaarheid;

}
