<?php

namespace DMT\Test\Insolvency\Soap\Request\ValueList;

use DMT\CommandBus\Validator\ValidationException;
use DMT\CommandBus\Validator\ValidationMiddleware;
use DMT\Insolvency\Soap\Request\ValueList\Court;
use PHPUnit\Framework\TestCase;

class CourtTest extends TestCase
{
    /**
     * @dataProvider provideCourt
     *
     * @param string $name
     * @param string $expected
     */
    public function testCourtByName(string $name, string $expected)
    {
        $this->assertSame($expected, (new Court($name))->court);
    }

    public function provideCourt(): iterable
    {
        foreach (array_unique(Court::COURTS) as $code => $name) {
            yield [$name, (string)$code];
        }
    }

    /**
     * @dataProvider provideInvalidCount
     *
     * @param string $court
     */
    public function testIllegalCourt(string $court)
    {
        $this->expectException(ValidationException::class);

        $validator = new ValidationMiddleware();
        $validator->execute(new Court($court), function () {});
    }

    public function provideInvalidCount(): iterable
    {
        return [['020'], ['Lutjebroek']];
    }
}
