<?php

namespace DMT\Test\Insolvency\Soap\Request;

use DMT\CommandBus\Validator\ValidationException;
use DMT\CommandBus\Validator\ValidationMiddleware;
use DMT\Insolvency\Soap\Request\SearchInsolvencyID;
use PHPUnit\Framework\TestCase;

class SearchInsolvencyIDTest extends TestCase
{
    /**
     * @dataProvider provideRequest
     *
     * @param SearchInsolvencyID $request
     */
    public function testValidation(SearchInsolvencyID $request)
    {
        $this->expectException(ValidationException::class);

        $validation = new ValidationMiddleware();
        $validation->execute($request, function () {});
    }

    public function provideRequest(): iterable
    {
        $requests = [
            'empty request' => [],
            'empty insolvency id' => ['insolvencyID' => null, 'court' => '01'],
            'invalid insolvency id' => ['insolvencyID' => 'B.12/34/56', 'court' => '01'],
            'illegal court' => ['insolvencyID' => 'R.10/20/340', 'court' => '234'],
        ];

        foreach ($requests as $request) {
            yield [$this->getRequest($request)];
        }
    }

    protected function getRequest(array $requestData): SearchInsolvencyID
    {
        $request = new SearchInsolvencyID();
        foreach ($requestData as $property => $value) {
            $request->{$property} = $value;
        }
        return $request;
    }
}
