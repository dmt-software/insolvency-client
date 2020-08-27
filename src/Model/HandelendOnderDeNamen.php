<?php

namespace DMT\Insolvency\Model;

use JMS\Serializer\Annotation as JMS;

/**
 * Class HandelendOnderDeNamen
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/inspubber01")
 * @JMS\XmlRoot("handelendOnderDeNamen", namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
 */
class HandelendOnderDeNamen
{
    /**
     * @JMS\Type("array<DMT\Insolvency\Model\HandelendOnderDeNaam>")
     * @JMS\XmlList(inline=true, entry="handelendOnderDeNaam", namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var HandelendOnderDeNaam[] $handelendOnderDeNaam
     */
    public $handelendOnderDeNaam;
}
