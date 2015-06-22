<?php
namespace DrdPlus\Cave\TablesBundle\Tables;

use Granam\Strict\Float\StrictFloat;

class WoundsMeasurement extends AbstractMeasurement
{
    const WOUNDS = 'wounds';

    public function __construct($value, $unit = self::WOUNDS)
    {
        parent::__construct($value, $unit);
    }

    /**
     * @return string[]
     */
    public function getPossibleUnits()
    {
        return [self::WOUNDS];
    }

    /**
     * @param float $value
     * @param string $unit
     */
    public function addInDifferentUnit($value, $unit)
    {
        $this->checkUnit($unit);
        if ($this->getValue() !== (new StrictFloat($value, false))->getValue()) {
            throw new \LogicException("Wounds already have a value {$this->getValue()} and can not be replaced by $value");
        }
    }

}
