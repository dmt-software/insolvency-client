<?php

namespace DMT\Insolvency\Soap\Request\ValueList;

use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Court
 */
class Court
{
    public const COURTS = [
        "01" => "'s-Hertogenbosch",
        "02" => "Breda",
        "03" => "Maastricht",
        "04" => "Roermond",
        "05" => "Arnhem",
        "06" => "Zutphen",
        "07" => "Zwolle-Lelystad",
        "08" => "Almelo",
        "09" => "'s-Gravenhage",
        "10" => "Rotterdam",
        "11" => "Dordrecht",
        "12" => "Middelburg",
        "13" => "Amsterdam",
        "14" => "Alkmaar",
        "15" => "Haarlem",
        "16" => "Utrecht",
        "17" => "Leeuwarden",
        "18" => "Groningen",
        "19" => "Assen",
        "40" => "Amsterdam",
        "41" => "Noord-Holland",
        "44" => "Oost-Nederland",
        "45" => "Den Haag",
        "46" => "Rotterdam",
        "47" => "Limburg",
        "48" => "Oost-Brabant",
        "49" => "Zeeland-West-Brabant",
        "50" => "Gelderland",
        "51" => "Overijssel",
    ];

    /**
     * @Assert\Choice(callback="getCourtCodes")
     *
     * @JMS\Type("string")
     * @JMS\XmlValue(cdata=false)
     *
     * @var string $court
     */
    public $court;

    /**
     * CourtList constructor.
     *
     * @param string $court
     */
    public function __construct(string $court)
    {
        if (in_array($court, self::COURTS)) {
            $court = (string)array_search($court, self::COURTS);
        }

        $this->court = $court;
    }

    /**
     * @return array
     */
    public static function getCourtCodes(): array
    {
        return array_map('strval', array_keys(self::COURTS));
    }
}
