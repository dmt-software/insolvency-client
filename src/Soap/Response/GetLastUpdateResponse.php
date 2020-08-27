<?php

namespace DMT\Insolvency\Soap\Response;

use DMT\Insolvency\Soap\Response;

/**
 * Class GetLastUpdateResponse
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/cir01")
 * @JMS\XmlRoot("GetLastUpdateResponse", namespace="http://www.rechtspraak.nl/namespaces/cir01")
 */
class GetLastUpdateResponse implements Response
{
    /**
     * @JMS\SerializedName("GetLastUpdateResult")
     * @JMS\Type("DMT\Insolvency\Soap\Response\GetLastUpdateResult")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/cir01")
     *
     * @var GetLastUpdateResult $getLastUpdateResult
     */
    public $getLastUpdateResult;

}
