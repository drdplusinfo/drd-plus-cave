<?php
namespace DrdPlus\Cave\TablesBundle\Tables\Weight;
use DrdPlus\Cave\TablesBundle\Tables\AbstractTable;
use DrdPlus\Cave\TablesBundle\Tables\DummyEvaluator;

/**
 * PPH page 164, bottom
 * @method WeightMeasurement toMeasurement($bonus, $unit)
 */
class WeightTable extends AbstractTable
{
    public function __construct()
    {
        parent::__construct(new DummyEvaluator());
    }

    protected function getDataFileName()
    {
        return __DIR__ . '/data/weight.csv';
    }

    protected function getExpectedDataHeader()
    {
        return [WeightMeasurement::KG];
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
        return $this->toMeasurement($bonus, WeightMeasurement::KG)->getValue();
    }

    public function kgToBonus($kg)
    {
        return $this->toBonus(new WeightMeasurement($kg, WeightMeasurement::KG));
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