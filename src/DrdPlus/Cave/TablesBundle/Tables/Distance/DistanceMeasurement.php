<?php
namespace DrdPlus\Cave\TablesBundle\Tables\Distance;

use DrdPlus\Cave\TablesBundle\Tables\AbstractMeasurement;
use Granam\Float\Tools\ToFloat;

class DistanceMeasurement extends AbstractMeasurement
{
    const M = 'm';
    const KM = 'km';

    /**
     * @return string[]
     */
    public function getPossibleUnits()
    {
        return [self::M, self::KM];
    }

    /**
     * @param float $value
     * @param string $unit
     */
    public function addInDifferentUnit($value, $unit)
    {
        $this->checkUnit($unit);
        $inOriginalUnit = $this->toDifferentUnit($value, $unit, $this->getUnit());
        if ($inOriginalUnit !== $this->getValue()) {
            throw new \LogicException(
                "Every another expression in another unit has to equal to original measure after conversion."
                . " Expected equation to {$this->getValue()}({$this->getUnit()}), got $value($unit) converted into"
                . " $inOriginalUnit({$this->getUnit()})"
            );
        }
        // distance conversion is always known, there is no reason to keep the "another" measure
    }

    public function toMeters()
    {
        return $this->toDifferentUnit($this->getValue(), $this->getUnit(), self::M);
    }

    private function toDifferentUnit($value, $fromUnit, $toUnit)
    {
        if ($fromUnit === $toUnit) {
            return ToFloat::toFloat($value);
        }
        if ($fromUnit === self::M && $toUnit === self::KM) {
            return $value / 1000;
        }
        if ($fromUnit === self::KM && $toUnit === self::M) {
            return $value * 1000;
        }
        throw new \LogicException("Unknown from / to units ($fromUnit / $toUnit)");
    }

    public function toKilometers()
    {
        return $this->toDifferentUnit($this->getValue(), $this->getUnit(), self::KM);
    }
}
