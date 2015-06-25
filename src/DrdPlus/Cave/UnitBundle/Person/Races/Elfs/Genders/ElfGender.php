<?php
namespace DrdPlus\Cave\UnitBundle\Person\Races\Elfs\Genders;

use DrdPlus\Cave\UnitBundle\Person\Races\Elfs\Elf;
use DrdPlus\Cave\UnitBundle\Person\Races\Gender;

abstract class ElfGender extends Gender
{

    /**
     * @return string
     */
    public static function getRaceCode()
    {
        return Elf::RACE_CODE;
    }

}
