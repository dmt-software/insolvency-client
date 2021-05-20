<?php

namespace Soap\Request\ValueList;

use DMT\CommandBus\Validator\ValidationException;
use DMT\CommandBus\Validator\ValidationMiddleware;
use DMT\Insolvency\Soap\Request\ValueList\PublicationType;
use PHPUnit\Framework\TestCase;

class PublicationTypeTest extends TestCase
{
    /**
     * @dataProvider providePublicationFailure
     *
     * @param array $types
     */
    public function testPublicationTypeFails(array $types)
    {
        $this->expectException(ValidationException::class);

        $validator = new ValidationMiddleware();
        $validator->execute(new PublicationType($types), function () {});
    }

    public function providePublicationFailure(): iterable
    {
        return [
            'unknown type' => [['Non existing type']],
            'too many types' => [[PublicationType::getPublicationTypes()] + [PublicationType::COMMENCEMENT_BANKRUPTCY]],
        ];
    }
}
