<?php
namespace DrdPlus\Cave\TablesBundle\Tables;

use Granam\Strict\Object\StrictObject;

class WoundsMeasurement extends StrictObject implements MeasurementInterface
{
    const WOUNDS = 'wounds';

    /**
     * @var float
     */
    private $value;
    /**
     * @var string
     */
    private $unit;

    /**
     * @param float $value
     * @param string $unit
     */
    public function __construct($value, $unit = self::WOUNDS)
    {
        $this->value = floatval($value);
        $this->checkUnit($unit);
        $this->unit = $unit;
    }

    /**
     * @param string $unit
     */
    private function checkUnit($unit)
    {
        switch ($unit) {
            case self::WOUNDS :
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
        return self::WOUNDS;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

}
