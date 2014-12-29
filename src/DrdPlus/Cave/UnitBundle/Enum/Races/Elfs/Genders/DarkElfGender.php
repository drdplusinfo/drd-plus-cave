<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Elfs\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\Elfs\DarkElf;

abstract class DarkElfGender extends ElfGender {

    /**
     * @return string
     */
    protected function getSubRaceCode()
    {
        return DarkElf::CODE;
    }

}
