<?php
namespace DrdPlus\Cave\TablesBundle\Tables;

/**
 * PPH page 164, bottom
 * TODO
 */
class WeightTable implements Table
{
    /**
     * @param int $bonus
     * @return float
     */
    public function toKg($bonus)
    {
        return $this->toValue($bonus);
    }

    /**
     * @param int
     * @return float
     */
    public function toValue($bonus)
    {
        // TODO: Implement toValue() method.
    }

    /**
     * @param float $value
     * @return int
     */
    public function toBonus($value)
    {
        // TODO: Implement toBonus() method.
    }
}
