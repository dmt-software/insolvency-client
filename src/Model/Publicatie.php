<?php

namespace DMT\Insolvency\Model;

use JMS\Serializer\Annotation as JMS;

/**
 * Class Publicatie
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/inspubber01")
 * @JMS\XmlRoot("publicatie", namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
 */
class Publicatie implements PublicatieCode, RechtbankCode
{
    /**
     * @JMS\SerializedName("publicatieDatum")
     * @JMS\Type("DateTime<'Y-m-d'>")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var \DateTime $publicatieDatum
     */
    public $publicatieDatum;

    /**
     * @JMS\SerializedName("publicatieKenmerk")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $publicatieKenmerk
     */
    public $publicatieKenmerk;

    /**
     * @JMS\SerializedName("publicatieOmschrijving")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $publicatieOmschrijving
     */
    public $publicatieOmschrijving;

    /**
     * @JMS\SerializedName("publicatieSoortCode")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $publicatieSoortCode
     */
    public $publicatieSoortCode;

    /**
     * @JMS\SerializedName("zittingslocatie")
     * @JMS\Type("DMT\Insolvency\Model\InspubZittingslocatie")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var InspubZittingslocatie $zittingslocatie
     */
    public $zittingslocatie;

    /**
     * @JMS\SerializedName("publicerendeInstantieCode")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $publicerendeInstantieCode
     */
    public $publicerendeInstantieCode;

}
