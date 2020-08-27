<?php

namespace DMT\Insolvency\Soap\Request;

use DMT\Insolvency\Soap\Request;
use JMS\Serializer\Annotation as JMS;

/**
 * Class GetLastUpdate
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/cir01")
 * @JMS\XmlRoot("GetLastUpdate", namespace="http://www.rechtspraak.nl/namespaces/cir01")
 */
class GetLastUpdate implements Request
{
    /** No arguments for this request */
}
