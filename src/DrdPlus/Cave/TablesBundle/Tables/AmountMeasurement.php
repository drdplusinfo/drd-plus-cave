<?php
namespace DrdPlus\Cave\TablesBundle\Tables;

use Granam\Strict\Object\StrictObject;

class AmountMeasurement extends StrictObject implements MeasurementInterface
{
    const AMOUNT = 'amount';

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
    public function __construct($value, $unit = self::AMOUNT)
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
            case self::AMOUNT :
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
        return self::AMOUNT;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

}
