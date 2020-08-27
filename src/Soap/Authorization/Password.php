<?php

namespace DMT\Insolvency\Soap\Authorization;

use JMS\Serializer\Annotation as JMS;

/**
 * Class Password
 */
class Password
{
    /**
     * @JMS\Type("string")
     * @JMS\XmlValue(cdata=false)
     *
     * @var string
     */
    public $password;

    /**
     * @JMS\SerializedName("Type")
     * @JMS\Type("string")
     * @JMS\XmlAttribute()
     *
     * @var string
     */
    public $typeUri;

    /**
     * Password constructor.
     *
     * @param string $password
     * @param string|null $typeUri
     */
    public function __construct(string $password, string $typeUri = null)
    {
        $this->password = $password;
        $this->typeUri = $typeUri;
    }
}
