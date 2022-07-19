<?php

namespace DMT\Insolvency\Soap;

use DMT\Http\Client\RequestHandler;
use DMT\Insolvency\Config;
use DMT\Insolvency\Exception\Exception;
use DMT\Insolvency\Exception\UnavailableException;
use GuzzleHttp\Psr7\Request as HttpRequest;
use JMS\Serializer\SerializerInterface;
use JMS\Serializer\Exception\Exception as SerializerException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestFactoryInterface;

/**
 * Class Handler
 */
class Handler
{
    protected RequestFactoryInterface $requestFactory;
    private SerializerInterface $serializer;
    private RequestHandler $requestHandler;
    private Config $config;

    /**
     * @param Config $config
     * @param RequestHandler $requestHandler
     * @param RequestFactoryInterface $requestFactory
     * @param SerializerInterface $serializer
     */
    public function __construct(
        Config $config,
        RequestHandler $requestHandler,
        RequestFactoryInterface $requestFactory,
        SerializerInterface $serializer
    ) {
        $this->config = $config;
        $this->requestHandler = $requestHandler;
        $this->requestFactory = $requestFactory;
        $this->serializer = $serializer;
    }

    /**
     * Handle the soap request.
     *
     * @param Request $request
     * @return Response
     * @throws Exception
     * @throws ClientExceptionInterface
     * @throws SerializerException
     */
    public function handle(Request $request): Response
    {
        $responseClass = $this->getResponseClassForRequest(get_class($request));

        $httpRequest = $this->requestFactory->createRequest('POST', $this->config->endPoint);
        $httpRequest->getBody()->write($this->serializer->serialize($request, 'soap'));

        $httpResponse = $this->requestHandler->handle($httpRequest);

        return $this->serializer->deserialize($httpResponse->getBody()->getContents(), $responseClass, 'soap');
    }

    /**
     * Map the soap request class to the right response class.
     *
     * @param string $request
     * @return string
     * @throws UnavailableException
     */
    protected function getResponseClassForRequest(string $request): string
    {
        $response = Response::class . '\\' . preg_replace('~^.*\\\\([^\\\\]+)$~', '$1', $request) . 'Response';

        return $response;
    }
}
