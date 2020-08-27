<?php

namespace DMT\Insolvency\Model;

use JMS\Serializer\Annotation as JMS;

/**
 * Class PublicatieLijst
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/cir01")
 * @JMS\XmlRoot("publicatieLijst", namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
 */
class PublicatieLijst
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
     * @JMS\Type("array<string>")
     * @JMS\XmlList(inline=true, entry="publicatieKenmerk", namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string[] $publicatieKenmerk
     */
    public $publicatieKenmerk;
}
