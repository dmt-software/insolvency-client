<?php

namespace DMT\Insolvency\Soap\Authorization;

use DateTime;
use JMS\Serializer\Annotation as JMS;

/**
 * Class Timestamp
 *
 * @JMS\XmlRoot(
 *     "Security",
 *     namespace="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd"
 * )
 */
class Timestamp
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
     * @JMS\SerializedName("Created")
     * @JMS\AccessType("DateTime<DateTime::RFC3339>")
     * @JMS\XmlElement(
     *     cdata=false,
     *     namespace="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd"
     * )
     *
     * @var DateTime
     */
    public $created;

    /**
     * @JMS\SerializedName("Expires")
     * @JMS\AccessType("DateTime<DateTime::RFC3339>")
     * @JMS\XmlElement(
     *     cdata=false,
     *     namespace="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd"
     * )
     *
     * @var DateTime
     */
    public $expires;
}
