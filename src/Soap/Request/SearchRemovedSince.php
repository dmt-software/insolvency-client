<?php

namespace DMT\Insolvency\Soap\Request;

use DMT\Insolvency\Soap\Request;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class SearchRemovedSince
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/cir01")
 * @JMS\XmlRoot("searchRemovedSince", namespace="http://www.rechtspraak.nl/namespaces/cir01")
 */
class SearchRemovedSince implements Request
{
    /**
     * @Assert\NotNull
     *
     * @JMS\SerializedName("modifyDate")
     * @JMS\Type("DateTime<'Y-m-d\TH:i:sP'>")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/cir01")
     *
     * @var \DateTime $modifyDate
     */
    public $modifyDate;
}
