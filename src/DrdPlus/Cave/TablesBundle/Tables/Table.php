<?php
namespace DrdPlus\Cave\TablesBundle\Tables;

interface Table
{
    /**
     * @param int
     * @return float
     */
    public function toValue($bonus);

    /**
     * @param float $value
     * @return int
     */
    public function toBonus($value);
}
