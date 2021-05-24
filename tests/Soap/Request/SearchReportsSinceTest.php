<?php

namespace DMT\Test\Insolvency\Soap\Request;

use DMT\CommandBus\Validator\ValidationException;
use DMT\CommandBus\Validator\ValidationMiddleware;
use DMT\Insolvency\Soap\Request\SearchReportsSince;
use PHPUnit\Framework\TestCase;

class SearchReportsSinceTest extends TestCase
{
    /**
     * @dataProvider provideRequest
     *
     * @param SearchReportsSince $request
     */
    public function testValidation(SearchReportsSince $request)
    {
        $this->expectException(ValidationException::class);

        $validation = new ValidationMiddleware();
        $validation->execute($request, function () {});
    }

    public function provideRequest(): iterable
    {
        $requests = [
            'empty request' => ['datetimeFrom'=> null, 'datetimeTo' => null],
            'empty start date' => ['datetimeFrom'=> null, 'datetimeTo' => '2015-04-05'],
            'empty end date' => ['datetimeFrom'=> '2015-05-04', 'datetimeTo' => null],
        ];

        foreach ($requests as $request) {
            yield [$this->getRequest($request)];
        }
    }

    protected function getRequest(array $requestData): SearchReportsSince
    {
        $request = new SearchReportsSince();
        foreach ($requestData as $property => $value) {
            $request->{$property} = $value ? new \DateTime($value) : null;
        }
        return $request;
    }
}
