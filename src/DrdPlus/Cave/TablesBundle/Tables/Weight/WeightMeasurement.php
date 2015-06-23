<?php
namespace DrdPlus\Cave\TablesBundle\Tables\Weight;

use DrdPlus\Cave\TablesBundle\Tables\AbstractMeasurement;
use Granam\Strict\Float\StrictFloat;

class WeightMeasurement extends AbstractMeasurement
{
    const KG = 'kg';

    public function __construct($value, $unit = self::KG)
    {
        parent::__construct($value, $unit);
    }

    /**
     * @return string[]
     */
    public function getPossibleUnits()
    {
        return [self::KG];
    }

    /**
     * @param float $value
     * @param string $unit
     */
    public function addInDifferentUnit($value, $unit)
    {
        $this->checkUnit($unit);
        if ($this->getValue() !== (new StrictFloat($value, false))->getValue()) {
            throw new \LogicException("Weight already have a value {$this->getValue()} and can not be replaced by $value");
        }
    }
}
