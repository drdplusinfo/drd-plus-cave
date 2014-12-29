<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Dwarfs\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\Gender;

abstract class DwarfGender extends Gender {

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
