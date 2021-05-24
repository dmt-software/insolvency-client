<?php

namespace DMT\Insolvency\Soap\Request;

use DMT\Insolvency\Soap\Request;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class SearchUndertaking
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/cir01")
 * @JMS\XmlRoot("searchUndertaking", namespace="http://www.rechtspraak.nl/namespaces/cir01")
 */
class SearchUndertaking implements Request
{
    /**
     * @JMS\SerializedName("name")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/cir01")
     *
     * @var string $name
     */
    public $name;

    /**
     * @Assert\Regex("~^\d{5,8}$~")
     *
     * @JMS\SerializedName("commercialRegisterID")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/cir01")
     *
     * @var string $commercialRegisterID
     */
    public $commercialRegisterID;

    /**
     * @Assert\Regex("~[1-9][0-9]{3}[A-Z]{2}~")
     *
     * @JMS\SerializedName("postalCode")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false)
     *
     * @var string $postalCode
     */
    public $postalCode;

    /**
     * @Assert\PositiveOrZero
     *
     * @JMS\SerializedName("houseNumber")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false)
     *
     * @var int $houseNumber
     */
    public $houseNumber;
}
