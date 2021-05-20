<?php

namespace DMT\Insolvency\Soap\Request;

use DMT\Insolvency\Soap\Request;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class SearchReportsSince
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/cir01")
 * @JMS\XmlRoot("searchReportsSince", namespace="http://www.rechtspraak.nl/namespaces/cir01")
 */
class SearchReportsSince implements Request
{
    /**
     * @Assert\NotNull
     *
     * @JMS\SerializedName("datetimeFrom")
     * @JMS\Type("DateTime<'Y-m-d\TH:i:sP'>")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/cir01")
     *
     * @var \DateTime $datetimeFrom
     */
    public $datetimeFrom;

    /**
     * @Assert\NotNull
     *
     * @JMS\SerializedName("datetimeTo")
     * @JMS\Type("DateTime<'Y-m-d\TH:i:sP'>")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/cir01")
     *
     * @var \DateTime $datetimeTo
     */
    public $datetimeTo;
}
