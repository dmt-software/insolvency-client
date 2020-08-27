<?php

namespace DMT\Insolvency\Soap\Authorization;

use DMT\Soap\Serializer\SoapHeaderInterface;
use JMS\Serializer\Annotation as JMS;

/**
 * Class WssHeader
 *
 * @JMS\XmlRoot(
 *     "Security",
 *     namespace="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"
 * )
 * @JMS\XmlNamespace(
 *     "http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd",
 *     prefix="wsse"
 * )
 * @JMS\XmlNamespace(
 *     "http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd",
 *     prefix="wsu"
 * )
 */
class Security implements SoapHeaderInterface
{
    /**
     * @JMS\SerializedName("mustUnderstand")
     * @JMS\Type("integer")
     * @JMS\XmlAttribute(namespace="http://schemas.xmlsoap.org/soap/envelope/")
     *
     * @var int|null [1 => true, 0 => false]
     */
    public $mustUnderstand;

    /**
     * @JMS\SerializedName("Timestamp")
     * @JMS\Type(Timestamp::class)
     * @JMS\XmlElement(
     *     cdata=false,
     *     namespace="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd"
     * )
     *
     * @var Timestamp
     */
    public $timestamp;

    /**
     * @JMS\SerializedName("UsernameToken")
     * @JMS\Type(UsernameToken::class)
     * @JMS\XmlElement(
     *     cdata=false,
     *     namespace="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"
     * )
     *
     * @var UsernameToken
     */
    public $usernameToken;
}
