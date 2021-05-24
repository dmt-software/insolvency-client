<?php

namespace DMT\Test\Insolvency\Soap\Request;

use DMT\CommandBus\Validator\ValidationException;
use DMT\CommandBus\Validator\ValidationMiddleware;
use DMT\Insolvency\Soap\Request\SearchModifiedSince;
use PHPUnit\Framework\TestCase;

class SearchModifiedSinceTest extends TestCase
{
    /**
     * Test empty modified since date.
     */
    public function testValidation()
    {
        $this->expectException(ValidationException::class);

        $validation = new ValidationMiddleware();
        $validation->execute(new SearchModifiedSince(), function () {});
    }
}
