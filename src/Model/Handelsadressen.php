<?php

namespace DMT\Insolvency\Model;

use JMS\Serializer\Annotation as JMS;

/**
 * Class Handelsadressen
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/inspubber01")
 * @JMS\XmlRoot("handelsadressen", namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
 */
class Handelsadressen
{
    /**
     * @JMS\Type("array<DMT\Insolvency\Model\InspubAdresHandelsnaamElem>")
     * @JMS\XmlList(inline=true, entry="handelsadres", namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var InspubAdresHandelsnaamElem[] $handelsadres
     */
    public $handelsadres;
}
