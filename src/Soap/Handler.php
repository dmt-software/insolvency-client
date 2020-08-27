<?php

namespace DMT\Insolvency\Soap;

use DMT\Insolvency\Config;
use DMT\Insolvency\Exception\Exception;
use DMT\Insolvency\Exception\UnavailableException;
use DMT\Insolvency\Http\Middleware\ExceptionMiddleware;
use DMT\Insolvency\Http\Middleware\SoapActionMiddleware;
use DMT\Insolvency\Soap\Serializer\SoapSerializer;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request as HttpRequest;
use JMS\Serializer\SerializerInterface;
use JMS\Serializer\Exception\Exception as SerializerException;
use Psr\Http\Client\ClientExceptionInterface;

/**
 * Class Handler
 */
class Handler
{
    /**
     * @var Config $config
     */
    protected $config;

    /**
     * @var SerializerInterface|null $serializer
     */
    protected $serializer;

    /**
     * @var HttpClient|null $httpClient
     * @todo make this guzzle independent
     */
    protected $httpClient;

    /**
     * Handler constructor.
     *
     * @param Config $config
     * @param SerializerInterface|null $serializer
     */
    public function __construct(Config $config, SerializerInterface $serializer = null)
    {
        $this->config = $config;
        $this->serializer = $serializer ?? new SoapSerializer($config);

        $stack = HandlerStack::create(new CurlHandler());
        $stack->push(Middleware::mapRequest(new SoapActionMiddleware()));
        $stack->push(Middleware::mapResponse(new ExceptionMiddleware()));
        $this->httpClient = new HttpClient([
            'base_uri' => $config->endPoint,
            'handler' => $stack,
        ]);
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

        $httpRequest = new HttpRequest('POST', '', []);
        $httpRequest->getBody()->write($this->serializer->serialize($request, 'soap'));

        $httpResponse = $this->httpClient->sendRequest($httpRequest);

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

        if (!class_exists($response)) {
            throw new UnavailableException('Unsupported method');
        }

        return $response;
    }
}
