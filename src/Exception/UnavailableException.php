<?php

namespace DMT\Insolvency\Exception;

use RuntimeException;

/**
 * Class UnavailableException
 *
 * Generic exception thrown when the service did not respond (correctly).
 */
class UnavailableException extends RuntimeException implements Exception
{

}
