<?php

namespace DMT\Test\Insolvency\Soap\Request;

use DMT\CommandBus\Validator\ValidationException;
use DMT\CommandBus\Validator\ValidationMiddleware;
use DMT\Insolvency\Soap\Request\GetCase;
use PHPUnit\Framework\TestCase;

class GetCaseTest extends TestCase
{
    /**
     * @dataProvider provideRequest
     *
     * @param GetCase $request
     */
    public function testValidation(GetCase $request)
    {
        $this->expectException(ValidationException::class);

        $validation = new ValidationMiddleware();
        $validation->execute($request, function () {});
    }

    public function provideRequest(): iterable
    {
        $request = new GetCase();
        $request->publicationNumber = '123.F.123';

        return [
            'empty publication number' => [new GetCase()],
            'invalid publication number' => [$request],
        ];
    }
}
