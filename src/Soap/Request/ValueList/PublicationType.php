<?php

namespace DMT\Insolvency\Soap\Request\ValueList;

use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class PublicationType
 */
class PublicationType
{
    /** Rulings on the commencement of bankruptcy procedures */
    public const COMMENCEMENT_BANKRUPTCY = 'Uitspraken faillissement';

    /** Rulings on the commencement of procedures on debt restucturing */
    public const COMMENCEMENT_DEPT_RESTRUCTURING = 'Uitspraken schuldsanering';

    /** Rulings on the commencement of procedures on moratorium */
    public const COMMENCEMENT_MORATORIUM = 'Uitspraken surseance';

    /** Rulings on the termination of bankruptcy procedures */
    public const TERMINATION_BANKRUPTCY = 'Einde faillissementen';

    /** Rulings on the termination of procedures on  debt restucturing */
    public const TERMINATION_DEPT_RESTRUCTURING = 'Einde schuldsaneringen';

    /** Rulings on the termination of moratorium */
    public const TERMINATION_MORATORIUM = 'Einde surseances';

    /** Other insolvency publications */
    public const OTHER_PUBLICATIONS = 'Overig';

    /**
     * @Assert\Choice(callback="getPublicationTypes", multiple=true, max=7)
     *
     * @JMS\Type("array<string>")
     * @JMS\XmlList(
     *     inline=true,
     *     entry="string"
     * )
     *
     * @var array
     */
    public $type;

    /**
     * PublicationType constructor.
     *
     * @param array $type
     */
    public function __construct(array $type)
    {
        $this->type = $type;
    }

    /**
     * @return array
     */
    public static function getPublicationTypes(): array
    {
        return [
            self::COMMENCEMENT_BANKRUPTCY,
            self::COMMENCEMENT_DEPT_RESTRUCTURING,
            self::COMMENCEMENT_MORATORIUM,
            self::TERMINATION_BANKRUPTCY,
            self::TERMINATION_DEPT_RESTRUCTURING,
            self::TERMINATION_MORATORIUM,
            self::OTHER_PUBLICATIONS,
        ];
    }
}
