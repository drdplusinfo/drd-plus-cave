<?php
namespace DrdPlus\Cave\TablesBundle\Tables;

class DistanceMeasurement implements MeasurementInterface
{
    const M = 'm';
    const KM = 'km';

    /**
     * @var float
     */
    private $value;
    /**
     * @var string
     */
    private $unit;

    public function __construct($value, $unit)
    {
        $this->value = floatval($value);
        $this->checkUnit($unit);
        $this->unit = $unit;
    }

    private function checkUnit($unit)
    {
        switch ($unit) {
            case self::M :
            case self::KM :
                return;
            default :
                throw new \LogicException('Unknown unit ' . var_export($unit, true));
        }
    }

    /**
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    public function toMeters()
    {
        if ($this->unit === self::M) {
            return $this->value;
        }

        return $this->value * 1000;
    }

    public function toKilometers()
    {
        if ($this->unit === self::KM) {
            return $this->value;
        }

        return $this->value / 1000;
    }
}
