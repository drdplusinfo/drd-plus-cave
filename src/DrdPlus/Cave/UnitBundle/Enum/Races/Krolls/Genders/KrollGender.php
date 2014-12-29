<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Krolls\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\Gender;

abstract class KrollGender extends Gender {

    /**
     * @return string
     */
    protected function getRaceCode()
    {
        return $this->getSubRaceCode();
    }

    /**
     * @return string
     */
    abstract protected function getSubRaceCode();

}
