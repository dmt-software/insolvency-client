<?php

namespace DMT\Insolvency\Validation;

use DMT\Insolvency\Model\RechtbankCode;

/**
 * Class Court
 */
class Court implements RechtbankCode
{
    /**
     * @return array
     */
    public static function getListValues(): array
    {
        return [
            self::COURT_01, self::COURT_02, self::COURT_03,
            self::COURT_04, self::COURT_05, self::COURT_06,
            self::COURT_07, self::COURT_08, self::COURT_09,
            self::COURT_10, self::COURT_11, self::COURT_12,
            self::COURT_13, self::COURT_14, self::COURT_15,
            self::COURT_16, self::COURT_17, self::COURT_18,
            self::COURT_19, self::COURT_40, self::COURT_41,
            self::COURT_44, self::COURT_45, self::COURT_46,
            self::COURT_47, self::COURT_48, self::COURT_49,
            self::COURT_50, self::COURT_51,
        ];
    }
}
