<?php

namespace DMT\Insolvency\ValueList;

/**
 * Class Court
 */
class Court
{
    /** Court 's-Hertogenbosch */
    public const COURT_01 = "01";

    /** Court Breda */
    public const COURT_02 = "02";

    /** Court Maastricht */
    public const COURT_03 = "03";

    /** Court Roermond */
    public const COURT_04 = "04";

    /** Court Arnhem */
    public const COURT_05 = "05";

    /** Court Zutphen */
    public const COURT_06 = "06";

    /** Court Zwolle-Lelystad */
    public const COURT_07 = "07";

    /** Court Almelo */
    public const COURT_08 = "08";

    /** Court 's-Gravenhage */
    public const COURT_09 = "09";

    /** Court Rotterdam */
    public const COURT_10 = "10";

    /** Court Dordrecht */
    public const COURT_11 = "11";

    /** Court Middelburg */
    public const COURT_12 = "12";

    /** Court Amsterdam */
    public const COURT_13 = "13";

    /** Court Alkmaar */
    public const COURT_14 = "14";

    /** Court Haarlem */
    public const COURT_15 = "15";

    /**  Court Utrecht */
    public const COURT_16 = "16";

    /** Court Leeuwarden */
    public const COURT_17 = "17";

    /** Court Groningen */
    public const COURT_18 = "18";

    /** Court Assen */
    public const COURT_19 = "19";

    /** Court Amsterdam */
    public const COURT_40 = "40";

    /** Court Noord-Holland */
    public const COURT_41 = "41";

    /** Court Oost-Nederland */
    public const COURT_44 = "44";

    /** Court Den Haag */
    public const COURT_45 = "45";

    /** Court Rotterdam */
    public const COURT_46 = "46";

    /** Court Limburg */
    public const COURT_47 = "47";

    /** Court Oost-Brabant */
    public const COURT_48 = "48";

    /** Court Zeeland-West-Brabant */
    public const COURT_49 = "49";

    /** Court Gelderland */
    public const COURT_50 = "50";

    /** Court Overijssel */
    public const COURT_51 = "51";

    /**
     * @return array
     */
    public static function getCourtCodes(): array
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
