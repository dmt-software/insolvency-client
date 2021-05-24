<?php

namespace DMT\Test\Insolvency\Soap\Request;

use DMT\CommandBus\Validator\ValidationException;
use DMT\CommandBus\Validator\ValidationMiddleware;
use DMT\Insolvency\Soap\Request\SearchByDate;
use PHPUnit\Framework\TestCase;

class SearchByDateTest extends TestCase
{
    /**
     * @dataProvider provideRequest
     *
     * @param SearchByDate $request
     */
    public function testValidation(SearchByDate $request)
    {
        $this->expectException(ValidationException::class);

        $validation = new ValidationMiddleware();
        $validation->execute($request, function () {});
    }

    public function provideRequest(): iterable
    {
        $requests = [
            'empty request' => [],
            'empty date'    => ['date' => null, 'court' => '41'],
            'empty court'   => ['date' => '2021-05-10', 'court' => null],
            'illegal court' => ['date' => '2021-05-10', 'court' => '432'],
            'unknown publication type' => ['date' => '2021-05-10', 'court' => '02', 'pubType' => '?'],
        ];

        foreach ($requests as $request) {
            yield [$this->getRequest($request)];
        }
    }

    protected function getRequest(array $requestData): SearchByDate
    {
        $request = new SearchByDate();
        foreach ($requestData as $property => $value) {
            if ($property === 'date' && $value) {
                $value = new \DateTime($value);
            }
            $request->{$property} = $value;
        }
        return $request;
    }
}
