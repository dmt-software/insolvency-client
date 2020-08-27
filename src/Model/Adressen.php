<?php

namespace DMT\Insolvency\Model;

use JMS\Serializer\Annotation as JMS;

/**
 * Class Adressen
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/inspubber01")
 * @JMS\XmlRoot("adressen", namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
 */
class Adressen
{
    /**
     * @JMS\SerializedName("geheimAdres")
     * @JMS\Type("bool")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var bool $geheimAdres
     */
    public $geheimAdres;

    /**
     * @JMS\Type("array<DMT\Insolvency\Model\Adres>")
     * @JMS\XmlList(inline=true, entry="adres", namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var Adres[] $adres
     */
    public $adres;
}
