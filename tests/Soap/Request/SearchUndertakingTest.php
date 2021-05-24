<?php

namespace DMT\Test\Insolvency\Soap\Request;

use DMT\CommandBus\Validator\ValidationException;
use DMT\CommandBus\Validator\ValidationMiddleware;
use DMT\Insolvency\Soap\Request\SearchUndertaking;
use PHPUnit\Framework\TestCase;

class SearchUndertakingTest extends TestCase
{
    /**
     * @dataProvider provideRequest
     *
     * @param SearchUndertaking $request
     */
    public function testValidation(SearchUndertaking $request)
    {
        $this->expectException(ValidationException::class);

        $validation = new ValidationMiddleware();
        $validation->execute($request, function () {});
    }

    public function provideRequest(): iterable
    {
        $request = new SearchUndertaking();
        $request->commercialRegisterID = '019387.1232';
        yield [$request];

        $request = new SearchUndertaking();
        $request->houseNumber = -1;
        yield [$request];

        $request = new SearchUndertaking();
        $request->postalCode = '1234';
        yield [$request];
    }
}
