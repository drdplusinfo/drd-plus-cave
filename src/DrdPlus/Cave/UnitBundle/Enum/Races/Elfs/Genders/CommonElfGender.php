<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Elfs\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\Elfs\CommonElf;

abstract class CommonElfGender extends ElfGender {

    /**
     * @return string
     */
    protected function getSubRaceCode()
    {
        return CommonElf::CODE;
    }

}
