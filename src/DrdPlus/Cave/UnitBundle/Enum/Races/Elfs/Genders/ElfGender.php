<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Elfs\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\Gender;

abstract class ElfGender extends Gender {

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
