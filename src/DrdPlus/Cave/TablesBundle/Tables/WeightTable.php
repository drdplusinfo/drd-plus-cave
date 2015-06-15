<?php
namespace DrdPlus\Cave\TablesBundle\Tables;

/**
 * PPH page 164, bottom
 * @method WeightMeasurement toMeasurement(int $bonus)
 */
class WeightTable extends  AbstractTable
{
    const KG = 'kg';

    protected function getDataFileName()
    {
        return __DIR__ . '/data/weight.csv';
    }

    protected function getExpectedDataHeader()
    {
        return [self::KG];
    }

    protected function getExpectedDataRowsCount()
    {
        return 100;
    }

    /**
     * @param int $bonus
     *
     * @return float
     */
    public function toKg($bonus)
    {
        return $this->toMeasurement($bonus)->getValue();
    }

    public function kgToBonus($kg)
    {
        return $this->toBonus(new WeightMeasurement($kg));
    }

    /**
     * @param float $value
     * @param string $unit
     *
     * @return WeightMeasurement
     */
    protected function convertToMeasurement($value, $unit)
    {
        return new WeightMeasurement($value, $unit);
    }


}
