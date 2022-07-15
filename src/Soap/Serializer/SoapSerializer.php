<?php

namespace DMT\Insolvency\Soap\Serializer;

use DMT\Insolvency\Client;
use DMT\Insolvency\Config;
use DMT\Insolvency\Soap\Authorization;
use DMT\Insolvency\Soap\Request;
use DMT\Insolvency\Soap\Response;
use DMT\Soap\Serializer\SoapDateHandler;
use DMT\Soap\Serializer\SoapDeserializationVisitorFactory;
use DMT\Soap\Serializer\SoapHeaderEventSubscriber;
use DMT\Soap\Serializer\SoapHeaderInterface;
use DMT\Soap\Serializer\SoapMessageEventSubscriber;
use DMT\Soap\Serializer\SoapNamespaceInterface;
use DMT\Soap\Serializer\SoapSerializationVisitorFactory;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\EventDispatcher\EventDispatcher;
use JMS\Serializer\Exception\Exception;
use JMS\Serializer\Handler\HandlerRegistry;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use Metadata\Cache\CacheInterface;

/**
 * Class SoapSerializer
 */
class SoapSerializer implements SerializerInterface
{
    /** @var Serializer $serializer */
    protected $serializer;

    /**
     * SoapSerializer constructor.
     *
     * @param Config $config
     * @param CacheInterface|null $metadataCache
     * @param array|null $metadataDirs
     */
    public function __construct(Client $client, Config $config, CacheInterface $metadataCache = null, array $metadataDirs = null)
    {
        $builder = new SerializerBuilder();

        if ($metadataCache) {
            $builder->setMetadataCache($metadataCache);
        }

        if ($metadataDirs) {
            $builder->setMetadataDirs($metadataDirs);
        }

        $this->serializer = $builder
            ->setSerializationVisitor('soap', (new SoapSerializationVisitorFactory())->setSoapVersion(SoapNamespaceInterface::SOAP_1_2))
            ->setDeserializationVisitor('soap', new SoapDeserializationVisitorFactory())
            ->setObjectConstructor(new ClientModelInstantiator($client))
            ->configureHandlers(
                function(HandlerRegistry $registry) {
                    $registry->registerSubscribingHandler(new SoapDateHandler());
                }
            )
            ->configureListeners(
                function (EventDispatcher $dispatcher) use ($config) {
                    $dispatcher->addSubscriber(new SoapExceptionEventSubscriber());
                    $dispatcher->addSubscriber(new SoapDateTimeSanitizerEventSubscriber());
                    $dispatcher->addSubscriber(new SoapMessageEventSubscriber());
                    $dispatcher->addSubscriber(new SoapHeaderEventSubscriber($this->getSoapHeader($config)));
                    $dispatcher->addSubscriber(new SoapAddressingEventSubscriber());
                    $dispatcher->addSubscriber(new AddIdentificationUriEventSubscriber($config));
                }
            )
            ->build();
    }

    /**
     * Serialize client request.
     *
     * @param Request $data
     * @param string $format
     * @param SerializationContext|null $context
     * @param string|null $type
     *
     * @return string
     * @throws Exception
     */
    public function serialize($data, string $format, ?SerializationContext $context = null, ?string $type = null): string
    {
        return $this->serializer->serialize($data, $format, $context, $type);
    }

    /**
     * Deserialize client response.
     *
     * @param string $data
     * @param string $type
     * @param string $format
     * @param DeserializationContext|null $context
     *
     * @return Response
     * @throws Exception
     */
    public function deserialize(string $data, string $type, string $format, ?DeserializationContext $context = null): Response
    {
        return $this->serializer->deserialize($data, $type, $format, $context);
    }

    /**
     * Get SOAP security header.
     *
     * @param Config $config
     *
     * @return SoapHeaderInterface
     */
    protected function getSoapHeader(Config $config): SoapHeaderInterface
    {
        $header = new Authorization\Security();
        $header->mustUnderstand = 1;
        $header->usernameToken = new Authorization\UsernameToken();
        $header->usernameToken->username = new Authorization\Username($config->user);
        $header->usernameToken->password = new Authorization\Password(
            $config->password,
            'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText'
        );

        return $header;
    }
}
