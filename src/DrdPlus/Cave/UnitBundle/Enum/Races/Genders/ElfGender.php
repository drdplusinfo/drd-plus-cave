<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\Elf;

abstract class ElfGender extends Gender {

    /**
     * @return string
     */
    protected function getRaceCode()
    {
        return Elf::CODE;
    }

}
