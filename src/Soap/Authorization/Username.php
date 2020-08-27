<?php

namespace DMT\Insolvency\Soap\Authorization;

use JMS\Serializer\Annotation as JMS;

/**
 * Class Username
 */
class Username
{
    /**
     * @JMS\Type("string")
     * @JMS\XmlValue(cdata=false)
     *
     * @var string
     */
    public $username;

    /**
     * Username constructor.
     *
     * @param string $username
     */
    public function __construct(string $username)
    {
        $this->username = $username;
    }
}
