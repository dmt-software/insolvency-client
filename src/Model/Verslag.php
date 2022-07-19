<?php

namespace DMT\Insolvency\Model;

use DMT\Insolvency\Client;
use JMS\Serializer\Annotation as JMS;

/**
 * Class Verslag
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/inspubber01")
 * @JMS\XmlRoot("verslag", namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
 */
class Verslag implements ConstructWithClientInterface
{
    use LazyLoadingPropertyTrait;

    /**
     * @JMS\SerializedName("insolventienummer")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $insolventienummer
     */
    public $insolventienummer;

    /**
     * @JMS\SerializedName("rechtbank")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $rechtbank
     */
    public $rechtbank;

    /**
     * @JMS\SerializedName("publicatiedatumVerslag")
     * @JMS\Type("DateTime<'Y-m-d\TH:i:sP'>")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var \DateTime $publicatiedatumVerslag
     */
    public $publicatiedatumVerslag;

    /**
     * @JMS\SerializedName("kenmerk")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $kenmerk
     */
    public $kenmerk;

    /**
     * @JMS\SerializedName("titel")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var string $titel
     */
    public $titel;

    /**
     * @JMS\SerializedName("eindverslag")
     * @JMS\Type("bool")
     * @JMS\XmlElement(cdata=false, namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
     *
     * @var bool $eindverslag
     */
    public $eindverslag;

    /**
     * @JMS\SerializedName("uri")
     * @JMS\Type("string")
     * @JMS\XmlAttribute()
     *
     * @var string $uri
     */
    public $uri;

    /**
     * @JMS\ReadOnlyProperty()
     *
     * @var Document|null $report
     */
    private $report;

    public function __construct(Client $client)
    {
        $this->report = function () use ($client) {
            if (!$this->kenmerk) {
                return null;
            }
            return $client->getReport($this->kenmerk);
        };
    }
}
