<?php

namespace DMT\Insolvency\Soap\Request;

use DMT\Insolvency\Soap\Request;
use DMT\Insolvency\Soap\Request\ValueList\Court;
use DMT\Insolvency\Soap\Request\ValueList\PublicationType;
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
     *
     * @JMS\SerializedName("court")
     * @JMS\Type("DMT\Insolvency\Soap\Request\ValueList\Court")
     * @JMS\XmlElement(namespace="http://www.rechtspraak.nl/namespaces/cir01")
     *
     * @var Court $court
     */
    public $court;

    /**
     * @JMS\SerializedName("pubType")
     * @JMS\Type("DMT\Insolvency\Soap\Request\ValueList\PublicationType")
     * @JMS\XmlElement(namespace="http://www.rechtspraak.nl/namespaces/cir01")
     *
     * @var PublicationType $pubType
     */
    public $pubType;

}
