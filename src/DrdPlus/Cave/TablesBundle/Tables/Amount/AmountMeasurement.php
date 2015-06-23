<?php
namespace DrdPlus\Cave\TablesBundle\Tables\Amount;

use DrdPlus\Cave\TablesBundle\Tables\AbstractMeasurement;
use Granam\Strict\Float\StrictFloat;

class AmountMeasurement extends AbstractMeasurement
{
    const AMOUNT = 'amount';

    public function __construct($value, $unit = self::AMOUNT)
    {
        parent::__construct($value, $unit);
    }

    public function getPossibleUnits()
    {
        return [self::AMOUNT];
    }

    /**
     * @param float $value
     * @param string $unit
     */
    public function addInDifferentUnit($value, $unit)
    {
        $this->checkUnit($unit);
        if ($this->getValue() !== (new StrictFloat($value, false))->getValue()) {
            throw new \LogicException(
                "The amount measurement accepts only {$this->getUnit()} and is already set to value of {$this->getValue()}"
            );
        }
    }

}
