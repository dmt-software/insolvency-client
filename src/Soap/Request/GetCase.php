<?php

namespace DMT\Insolvency\Soap\Request;

use DMT\Insolvency\Soap\Request;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class GetCase
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/cir01")
 * @JMS\XmlRoot("getCase", namespace="http://www.rechtspraak.nl/namespaces/cir01")
 */
class GetCase implements Request
{
    /**
     * @Assert\NotNull
     * @Assert\Regex("~([0-9]{2}\.){0,1}[a-z]{3}\.[0-9]{2}\.[0-9]{1,4}\.[F|S|R]\.[0-9]{4}\.[0-9]{1,2}\.[0-9]{2}~")
     *
     * @JMS\SerializedName("publicationNumber")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false)
     *
     * @var string $publicationNumber
     */
    public $publicationNumber;
}
