<?php

namespace DMT\Insolvency\Soap\Request;

use DMT\Insolvency\Soap\Request;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class SearchByDate
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/cir01")
 * @JMS\XmlRoot("searchByDate", namespace="http://www.rechtspraak.nl/namespaces/cir01")
 */
class SearchByDate implements Request
{
    /**
     * @Assert\NotNull
     *
     * @JMS\SerializedName("date")
     * @JMS\Type("DateTime<'Y-m-d\TH:i:sP'>")
     * @JMS\XmlElement(cdata=false)
     *
     * @var \DateTime $date
     */
    public $date;

    /**
     * @Assert\NotNull
     * @Assert\Choice(callback="DMT\Insolvency\ValueList\Court::getCourtCodes")
     *
     * @JMS\SerializedName("court")
     * @JMS\Type("string")
     * @JMS\XmlElement(namespace="http://www.rechtspraak.nl/namespaces/cir01")
     *
     * @var string $court
     */
    public $court;

    /**
     * @Assert\Choice(callback="DMT\Insolvency\ValueList\getPublicationTypes", multiple=true, max=7)
     *
     * @JMS\SerializedName("pubType")
     * @JMS\Type("string")
     * @JMS\XmlElement(namespace="http://www.rechtspraak.nl/namespaces/cir01")
     *
     * @var string $pubType
     */
    public $pubType;

}
