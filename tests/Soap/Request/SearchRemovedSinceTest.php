<?php

namespace DMT\Test\Insolvency\Soap\Request;

use DMT\CommandBus\Validator\ValidationException;
use DMT\CommandBus\Validator\ValidationMiddleware;
use DMT\Insolvency\Soap\Request\SearchRemovedSince;
use PHPUnit\Framework\TestCase;

class SearchRemovedSinceTest extends TestCase
{
    /**
     * Test empty removed since date.
     */
    public function testValidation()
    {
        $this->expectException(ValidationException::class);

        $validation = new ValidationMiddleware();
        $validation->execute(new SearchRemovedSince(), function () {});
    }
}
