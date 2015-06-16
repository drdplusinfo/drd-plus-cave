<?php
namespace DrdPlus\Cave\TablesBundle\Tables;

class WeightMeasurement implements MeasurementInterface
{
    const KG = 'kg';

    /**
     * @var float
     */
    private $value;
    /**
     * @var string
     */
    private $unit;

    public function __construct($value, $unit = self::KG)
    {
        $this->value = floatval($value);
        $this->checkUnit($unit);
        $this->unit = $unit;
    }

    private function checkUnit($unit)
    {
        if ($unit !== self::KG) {
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

}
