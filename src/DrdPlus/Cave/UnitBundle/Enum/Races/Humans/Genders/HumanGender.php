<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Humans\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\Gender;

abstract class HumanGender extends Gender {

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
