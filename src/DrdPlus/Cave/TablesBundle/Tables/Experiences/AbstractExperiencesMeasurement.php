<?php
namespace DrdPlus\Cave\TablesBundle\Tables\Experiences;

use DrdPlus\Cave\TablesBundle\Tables\AbstractMeasurement;
use Granam\Integer\Tools\ToInteger;

abstract class AbstractExperiencesMeasurement extends AbstractMeasurement
{

    /**
     * @return int
     */
    abstract public function toLevel();

    /**
     * @return int
     */
    abstract public function toExperiences();

    /**
     * @return int
     */
    public function getValue()
    {
        return ToInteger::toInteger(parent::getValue());
    }

    /**
     * @param float $value
     * @param string $unit
     */
    public function addInDifferentUnit($value, $unit)
    {
        $this->checkUnit($unit);
        if ($this->getValue() !== ToInteger::toInteger($value)) {
            throw new \LogicException("Experiences already has a value {$this->getValue()} and can not be replaced by $value");
        }
    }
}
