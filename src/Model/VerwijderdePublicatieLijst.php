<?php

namespace DMT\Insolvency\Model;

use JMS\Serializer\Annotation as JMS;

/**
 * Class VerwijderdePublicatieLijst
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/cir01")
 * @JMS\XmlRoot("verwijderdePublicatieLijst", namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
 */
class VerwijderdePublicatieLijst
{
    /**
     * @JMS\SerializedName("extractiedatum")
     * @JMS\Type("DateTime<'Y-m-d\TH:i:sP'>")
     * @JMS\XmlAttribute()
     *
     * @var \DateTime $extractiedatum
     */
    public $extractiedatum;

    /**
     * @JMS\Type("array<DMT\Insolvency\Model\VerwijderdeInsolventie>")
     * @JMS\XmlList(inline=true, entry="verwijderdeInsolventie", namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var VerwijderdeInsolventie[] $verwijderdeInsolventie
     */
    public $verwijderdeInsolventie;
}