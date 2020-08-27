<?php

namespace DMT\Insolvency\Soap\Authorization;

use JMS\Serializer\Annotation as JMS;

/**
 * Class UsernameToken
 *
 * @JMS\XmlRoot(
 *     "UsernameToken",
 *     namespace="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"
 * )
 */
class UsernameToken
{
    /**
     * @JMS\SerializedName("Id")
     * @JMS\Type("string")
     * @JMS\XmlAttribute(namespace="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd")
     *
     * @var string
     */
    public $id;

    /**
     * @JMS\SerializedName("Username")
     * @JMS\Type(Username::class)
     * @JMS\XmlElement(
     *     cdata=false,
     *     namespace="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"
     * )
     *
     * @var Username
     */
    public $username;

    /**
     * @JMS\SerializedName("Password")
     * @JMS\Type(Password::class)
     * @JMS\XmlElement(
     *     cdata=false,
     *     namespace="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"
     * )
     *
     * @var Password
     */
    public $password;
}