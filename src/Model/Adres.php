<?php

namespace DMT\Insolvency\Model;

use JMS\Serializer\Annotation as JMS;

/**
 * Class Adres
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/inspubber01")
 * @JMS\XmlRoot("adres", namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
 */
class Adres extends InspubAdresInsolvente implements AdresType
{
    /**
     * @JMS\SerializedName("adresType")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string
     */
    public $adresType;
}
