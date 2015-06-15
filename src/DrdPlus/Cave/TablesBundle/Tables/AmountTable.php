<?php
namespace DrdPlus\Cave\TablesBundle\Tables;

/**
 * PPH page 164, top
 * @method AmountMeasurement toMeasurement(int $bonus)
 */
class AmountTable extends  AbstractTable
{

    protected function getDataFileName()
    {
        return __DIR__ . '/data/amount.csv';
    }

    protected function getExpectedDataHeader()
    {
        return [AmountMeasurement::AMOUNT];
    }

    protected function getExpectedDataRowsCount()
    {
        return 120;
    }

    /**
     * @param int $bonus
     *
     * @return float
     */
    public function toAmount($bonus)
    {
        return $this->toMeasurement($bonus)->getValue();
    }

    /**
     * @param float $amount
     *
     * @return int
     */
    public function amountToBonus($amount)
    {
        return $this->toBonus(new AmountMeasurement($amount));
    }

    /**
     * @param float $value
     * @param string $unit
     *
     * @return AmountMeasurement
     */
    protected function convertToMeasurement($value, $unit)
    {
        return new AmountMeasurement($value, $unit);
    }

}
