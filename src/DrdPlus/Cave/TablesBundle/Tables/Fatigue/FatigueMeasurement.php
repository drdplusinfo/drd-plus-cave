<?php
namespace DrdPlus\Cave\TablesBundle\Tables\Fatigue;

use DrdPlus\Cave\TablesBundle\Tables\AbstractMeasurement;
use Granam\Strict\Float\StrictFloat;

class FatigueMeasurement extends AbstractMeasurement
{
    const FATIGUE = 'fatigue';

    public function __construct($value, $unit = self::FATIGUE)
    {
        parent::__construct($value, $unit);
    }

    public function getPossibleUnits()
    {
        return [self::FATIGUE];
    }

    /**
     * @param float $value
     * @param string $unit
     */
    public function addInDifferentUnit($value, $unit)
    {
        $this->checkUnit($unit);
        if ($this->getValue() !== (new StrictFloat($value, false))->getValue()) {
            throw new \LogicException("Fatigue already has a value {$this->getValue()} and can not be replaced by $value");
        }
    }

}
