<?php

namespace DMT\Test\Insolvency\Soap\Request;

use DMT\CommandBus\Validator\ValidationException;
use DMT\CommandBus\Validator\ValidationMiddleware;
use DMT\Insolvency\Soap\Request\GetCaseWithReports;
use PHPUnit\Framework\TestCase;

class GetCaseWithReportsTest extends TestCase
{
    /**
     * @dataProvider provideRequest
     *
     * @param GetCaseWithReports $request
     */
    public function testValidation(GetCaseWithReports $request)
    {
        $this->expectException(ValidationException::class);

        $validation = new ValidationMiddleware();
        $validation->execute($request, function () {});
    }

    public function provideRequest(): iterable
    {
        $request = new GetCaseWithReports();
        $request->publicationNumber = 'B-234';

        return [
            'empty publication number' => [new GetCaseWithReports()],
            'invalid publication number' => [$request],
        ];
    }
}

