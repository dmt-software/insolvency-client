<?php

namespace DMT\Insolvency\Model;

use JMS\Serializer\Annotation as JMS;

/**
 * Class HandelendOnderDeNaam
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/inspubber01")
 * @JMS\XmlRoot("handelendOnderDeNaam", namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
 */
class HandelendOnderDeNaam extends InspubHandelendOnderDeNaamElem
{
    /**
     * @JMS\SerializedName("voorheen")
     * @JMS\Type("bool")
     * @JMS\XmlAttribute()
     *
     * @var string $voorheen
     */
    public $voorheen;
}
