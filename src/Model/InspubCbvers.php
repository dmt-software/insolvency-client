<?php

namespace DMT\Insolvency\Model;

use JMS\Serializer\Annotation as JMS;

/**
 * Class InspubCbvers
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/inspubber01")
 * @JMS\XmlRoot("inspubCbvers", namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
 */
class InspubCbvers
{
    /**
     * @JMS\Type("array<DMT\Insolvency\Model\InspubCbvElem>")
     * @JMS\XmlList(inline=true, entry="cbv", namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var InspubCbvElem[] $cbv
     */
    public $cbv;
}
