<?php

namespace DMT\Insolvency\Model;

use JMS\Serializer\Annotation as JMS;

/**
 * Class VerwijderdeInsolventie
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/cir01")
 * @JMS\XmlRoot("verwijderdeInsolventie", namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
 */
class VerwijderdeInsolventie
{
    /**
     * @JMS\SerializedName("insolventienummer")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $insolventienummer
     */
    public $insolventienummer;

    /**
     * @JMS\SerializedName("publicatieKenmerk")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $publicatieKenmerk
     */
    public $publicatieKenmerk;

    /**
     * @JMS\SerializedName("reden")
     * @JMS\Type("string'>")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $reden
     */
    public $reden;
}
