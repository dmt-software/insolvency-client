<?php

namespace DMT\Insolvency\Soap;

use DMT\Insolvency\Exception\Exception;
use DMT\Insolvency\Exception\UnavailableException;
use GuzzleHttp\Client as HttpClient;
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
     * @var SerializerInterface $serializer
     */
    protected $serializer;

    /**
     * @var HttpClient $httpClient
     */
    protected $httpClient;

    /**
     * Handler constructor.
     *
     * @param HttpClient $httpClient
     * @param SerializerInterface $serializer
     */
    public function __construct(HttpClient $httpClient, SerializerInterface $serializer)
    {
        $this->httpClient = $httpClient;
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
