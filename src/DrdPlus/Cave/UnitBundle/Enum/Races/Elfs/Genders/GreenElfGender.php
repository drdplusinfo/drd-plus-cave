<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Elfs\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\Elfs\GreenElf;

abstract class GreenElfGender extends ElfGender {

    /**
     * @return string
     */
    protected function getSubRaceCode()
    {
        return GreenElf::CODE;
    }

}
