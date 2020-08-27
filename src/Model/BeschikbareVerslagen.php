<?php

namespace DMT\Insolvency\Model;

use JMS\Serializer\Annotation as JMS;

/**
 * Class BeschikbareVerslagen
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/inspubber01")
 * @JMS\XmlRoot("beschikbareVerslagen", namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
 */
class BeschikbareVerslagen
{
    /**
     * @JMS\Type("array<DMT\Insolvency\Model\Verslag>")
     * @JMS\XmlList(inline=true, entry="verslag", namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var Verslag[] $verslag
     */
    public $verslag;
}
