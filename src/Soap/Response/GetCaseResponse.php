<?php

namespace DMT\Insolvency\Soap\Response;

use DMT\Insolvency\Soap\Response;
use JMS\Serializer\Annotation as JMS;

/**
 * Class GetCaseResponse
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/cir01")
 * @JMS\XmlRoot("getCaseResponse", namespace="http://www.rechtspraak.nl/namespaces/cir01")
 */
class GetCaseResponse implements Response
{
    /**
     * @JMS\SerializedName("getCaseResult")
     * @JMS\Type("DMT\Insolvency\Soap\Response\GetCaseResult")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/cir01")
     *
     * @var GetCaseResult $getCaseResult
     */
    public $getCaseResult;

}
