<?php

namespace DMT\Test\Insolvency\Soap\Request;

use DMT\CommandBus\Validator\ValidationException;
use DMT\CommandBus\Validator\ValidationMiddleware;
use DMT\Insolvency\Soap\Request\SearchNaturalPerson;
use PHPUnit\Framework\TestCase;

class SearchNaturalPersonTest extends TestCase
{
    /**
     * @dataProvider provideRequest
     *
     * @param SearchNaturalPerson $request
     */
    public function testValidation(SearchNaturalPerson $request)
    {
        $this->expectException(ValidationException::class);

        $validation = new ValidationMiddleware();
        $validation->execute($request, function () {});
    }

    public function provideRequest(): iterable
    {
        $request = new SearchNaturalPerson();
        $request->houseNumber = -1;
        yield [$request];

        $request = new SearchNaturalPerson();
        $request->postalCode = '1234';
        yield [$request];
    }
}
