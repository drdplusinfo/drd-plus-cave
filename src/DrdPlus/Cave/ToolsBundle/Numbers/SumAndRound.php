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

    /**
     * @param int $firstNumber
     * @param int $secondNumber
     *
     * @return int
     */
    public static function average($firstNumber, $secondNumber)
    {
        return self::round(($firstNumber + $secondNumber) / 2);
    }

    /**
     * @param int $number
     *
     * @return int
     */
    public static function half($number)
    {
        return self::round($number / 2);
    }
}
