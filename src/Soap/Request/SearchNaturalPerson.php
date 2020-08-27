<?php

namespace DMT\Insolvency\Soap\Request;

use DMT\Insolvency\Soap\Request;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class SearchNaturalPerson
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/cir01")
 * @JMS\XmlRoot("searchNaturalPerson", namespace="http://www.rechtspraak.nl/namespaces/cir01")
 */
class SearchNaturalPerson implements Request
{
    /**
     * @JMS\SerializedName("dateOfBirth")
     * @JMS\Type("DateTime<'Y-m-d'>")
     * @JMS\XmlElement(cdata=false)
     *
     * @var \DateTime $dateOfBirth
     */
    public $dateOfBirth;

    /**
     * @JMS\SerializedName("prefix")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false)
     *
     * @var string $prefix
     */
    public $prefix;

    /**
     * @JMS\SerializedName("surname")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false)
     *
     * @var string $surname
     */
    public $surname;

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
}
