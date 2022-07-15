<?php

namespace DMT\Insolvency\Soap\Serializer;

use DMT\Insolvency\Client;
use DMT\Insolvency\Model\ConstructWithClientInterface;
use JMS\Serializer\Construction\ObjectConstructorInterface;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\Metadata\ClassMetadata;
use JMS\Serializer\Visitor\DeserializationVisitorInterface;

class ClientModelInstantiator implements ObjectConstructorInterface
{
    private Client $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @inheritDoc
     */
    public function construct(DeserializationVisitorInterface $visitor, ClassMetadata $metadata, $data, array $type, DeserializationContext $context): ?object
    {
        $params = [];
        if (is_a($metadata->name, ConstructWithClientInterface::class, true)) {
            $params = [$this->client];
        }

        return new $metadata->name(...$params);
    }
}
