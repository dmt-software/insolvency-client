<?php

namespace DMT\Insolvency\Model;

use DMT\Insolvency\Client;
use DMT\Insolvency\Soap\Response\GetCaseResponse;
use DMT\Insolvency\Soap\Response\GetCaseWithReportsResponse;
use JMS\Serializer\Annotation as JMS;

/**
 * Class PublicatieReference
 *
 * @JMS\XmlNamespace("http://www.rechtspraak.nl/namespaces/cir01")
 * @JMS\XmlRoot("publicatieKenmerk", namespace="http://www.rechtspraak.nl/namespaces/inspubber01")
 */
class PublicatieReference implements ConstructWithClientInterface
{
    use LazyLoadingPropertyTrait;

    /**
     * @JMS\Type("string")
     * @JMS\XmlValue()
     *
     * @var string $publicatieKenmerk
     */
    public $publicatieKenmerk;

    /**
     * @JMS\ReadOnlyProperty()
     *
     * @var Insolvente $insolvente
     */
    private $insolvente;

    public function __construct(Client $client)
    {
        $this->insolvente = function () use ($client) {
            $case = $client->getCaseWithReports($this->publicatieKenmerk);

            return $case->result->inspubWebserviceInsolvente->insolvente;
        };
    }


}
