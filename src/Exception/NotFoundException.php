<?php

namespace DMT\Insolvency\Exception;

use RuntimeException;

/**
 * Class NotFoundException
 *
 * Thrown when the requested data is not found or an empty list is returned.
 */
class NotFoundException extends RuntimeException implements Exception
{

}
