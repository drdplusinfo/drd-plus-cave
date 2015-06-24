<?php
namespace DrdPlus\Cave\ToolsBundle\Numbers;

class SumAndRound
{

    /**
     * @param float $number
     *
     * @return int
     */
    public static function round($number)
    {
        return intval(round($number));
    }

    /**
     * @param float $number
     *
     * @return int
     */
    public static function floor($number)
    {
        return intval(floor($number));
    }

    public static function average($firstNumber, $secondNumber)
    {
        return self::round(($firstNumber + $secondNumber) / 2);
    }
}
