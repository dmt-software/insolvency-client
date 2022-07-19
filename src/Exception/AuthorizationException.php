<?php

namespace DMT\Insolvency\Exception;

use InvalidArgumentException;

/**
 * Class AuthorizationException
 *
 * Thrown on several authorization problems, like missing or incorrect credentials.
 */
class AuthorizationException extends InvalidArgumentException implements Exception
{

}
