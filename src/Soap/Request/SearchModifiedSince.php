<?php

namespace DMT\Insolvency\Soap\Request;

use DMT\Insolvency\Soap\Request;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class SearchModifiedSince
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/cir01")
 * @JMS\XmlRoot("searchModifiedSince", namespace="http://www.rechtspraak.nl/namespaces/cir01")
 */
class SearchModifiedSince implements Request
{
    /**
     * @Assert\NotNull
     *
     * @JMS\SerializedName("modifyDate")
     * @JMS\Type("DateTime<'Y-m-d\TH:i:sP'>")
     * @JMS\XmlElement(cdata=false)
     *
     * @var \DateTime $modifyDate
     */
    public $modifyDate;
}
