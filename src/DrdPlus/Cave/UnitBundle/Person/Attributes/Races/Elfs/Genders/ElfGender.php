<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Elfs\Genders;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Elfs\Elf;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Gender;

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
