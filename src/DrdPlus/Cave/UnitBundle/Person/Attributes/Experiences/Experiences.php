<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes;

use Doctrineum\Integer\IntegerEnum;
use Granam\Integer\IntegerInterface;

class Experiences extends IntegerEnum implements IntegerInterface
{
    /**
     * @return int
     */
    public function getValue()
    {
        return $this->getEnumValue();
    }

}
