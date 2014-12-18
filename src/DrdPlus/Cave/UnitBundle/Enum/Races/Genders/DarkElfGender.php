<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\DarkElf;

abstract class DarkElfGender extends Gender {

    /**
     * @return string
     */
    protected function getRaceCode()
    {
        return DarkElf::CODE;
    }

}
