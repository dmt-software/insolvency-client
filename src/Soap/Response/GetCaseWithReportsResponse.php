<?php

namespace DMT\Insolvency\Soap\Response;

use DMT\Insolvency\Soap\Response;
use JMS\Serializer\Annotation as JMS;

/**
 * Class GetCaseWithReportsResponse
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/cir01")
 * @JMS\XmlRoot("getCaseWithReportsResponse", namespace="http://www.rechtspraak.nl/namespaces/cir01")
 */
class GetCaseWithReportsResponse implements Response
{
    /**
     * @JMS\SerializedName("getCaseWithReportsResult")
     * @JMS\Type("DMT\Insolvency\Soap\Response\GetCaseWithReportsResult")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/cir01")
     *
     * @var GetCaseWithReportsResult $getCaseWithReportsResult
     */
    public $getCaseWithReportsResult;

}
