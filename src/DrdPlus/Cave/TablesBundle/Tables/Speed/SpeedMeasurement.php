<?php
namespace DrdPlus\Cave\TablesBundle\Tables\Speed;

use DrdPlus\Cave\TablesBundle\Tables\AbstractMeasurement;
use Granam\Strict\Float\StrictFloat;

class SpeedMeasurement extends AbstractMeasurement
{
    private $inDifferentUnits = [];

    const M_PER_ROUND = 'm/round';
    const KM_PER_HOUR = 'km/h';

    public function getPossibleUnits()
    {
        return [self::M_PER_ROUND, self::KM_PER_HOUR];
    }

    /**
     * @param float $value
     * @param string $unit
     */
    public function addInDifferentUnit($value, $unit)
    {
        $this->checkUnit($unit);
        $this->checkProportion($value, $unit, $this->getValue(), $this->getUnit());
        $this->inDifferentUnits[$unit] = (new StrictFloat($value, false))->getValue();
    }

    private function checkProportion($value, $unit, $originalValue, $originalUnit)
    {
        if ($unit === $originalUnit) {
            if ($value !== $originalValue) {
                throw new \LogicException;
            }
        } else if ($unit === self::M_PER_ROUND && $originalUnit === self::KM_PER_HOUR) {
            if ($value <= $originalValue) {
                throw new \LogicException;
            }
        } else if ($unit === self::KM_PER_HOUR && $originalUnit === self::M_PER_ROUND) {
            if ($value >= $originalValue) {
                throw new \LogicException;
            }
        }
    }

    public function toMetersPerRound()
    {
        if ($this->getUnit() !== self::M_PER_ROUND) {
            if (isset($this->inDifferentUnits[self::M_PER_ROUND])) {
                // conversion has been set already
                return $this->inDifferentUnits[self::M_PER_ROUND];
            }
            throw new \LogicException(
                "Can not convert {$this->getValue()}({$this->getUnit()}) into " . self::M_PER_ROUND
            );
        }

        return $this->getValue();
    }

    public function toKilometersPerHour()
    {
        if ($this->getUnit() !== self::KM_PER_HOUR) {
            if (isset($this->inDifferentUnits[self::KM_PER_HOUR])) {
                // conversion has been set already
                return $this->inDifferentUnits[self::KM_PER_HOUR];
            }
            throw new \LogicException(
                "Can not convert {$this->getValue()}({$this->getUnit()}) into " . self::KM_PER_HOUR
            );
        }

        return $this->getValue();
    }
}
