<?php

namespace DMT\Insolvency\Soap\Request;

use DMT\Insolvency\Soap\Request;
use DMT\Insolvency\Soap\Request\ValueList\Court;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class SearchInsolvencyID
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/cir01")
 * @JMS\XmlRoot("searchInsolvencyID", namespace="http://www.rechtspraak.nl/namespaces/cir01")
 */
class SearchInsolvencyID implements Request
{
    /**
     * @Assert\Regex("~[F|S|R]\.(\d{2}/){0,1}\d{2}/\d{1,4}~")
     *
     * @JMS\SerializedName("insolvencyID")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false)
     *
     * @var string $insolvencyID
     */
    public $insolvencyID;

    /**
     * @JMS\SerializedName("court")
     * @JMS\Type("DMT\Insolvency\Soap\Request\ValueList\Court")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/cir01")
     *
     * @var Court $court
     */
    public $court;
}
