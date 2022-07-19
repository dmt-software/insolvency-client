<?php

namespace DMT\Insolvency\Exception;

use RuntimeException;

/**
 * Class ResponseException
 *
 * Thrown when a response could not be constructed due to too many results for instance.
 */
class ResponseException extends RuntimeException implements Exception
{

}