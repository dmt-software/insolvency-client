<?php

namespace DMT\Insolvency\Exception;

use DMT\CommandBus\Validator\ValidationException;
use DMT\Insolvency\Http\Request\GetReport;
use DMT\Insolvency\Http\Response\GetReportResponse;
use DMT\Insolvency\Soap\Request;
use DMT\Insolvency\Soap\Response;
use JMS\Serializer\Exception\Exception as SerializerException;
use League\Tactician\Middleware;
use Psr\Http\Client\ClientExceptionInterface;

/**
 * Class ExceptionMiddleware
 */
class ExceptionMiddleware implements Middleware
{
    /**
     * @param Request|GetReport $command
     * @param callable $next
     * @return Response|GetReportResponse
     * @throws Exception
     */
    public function execute($command, callable $next)
    {
        try {
            /** @var Response|GetReportResponse $response */
            return $next($command);
        } catch (Exception $exception) {
            throw $exception;
        } catch (ClientExceptionInterface $exception) {
            throw new UnavailableException($exception->getMessage(), 0, $exception);
        } catch (ValidationException $exception) {
            throw new RequestException($exception->getMessage(), 0, $exception);
        } catch (SerializerException $exception) {
            throw new UnavailableException($exception->getMessage(), 0, $exception);
        }
    }
}
