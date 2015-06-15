<?php
namespace DrdPlus\Cave\TablesBundle\Tables;

class AmountMeasurement implements MeasurementInterface
{
    const AMOUNT = 'amount';

    /**
     * @var float
     */
    private $value;

    public function __constructor($value)
    {
        $this->value = $value;
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
