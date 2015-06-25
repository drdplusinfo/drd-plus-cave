<?php
namespace DrdPlus\Cave\UnitBundle\Person\Races\Elfs\Genders;

use DrdPlus\Cave\UnitBundle\Person\Races\Elfs\DarkElf;

abstract class DarkElfGender extends ElfGender
{

    /**
     * @return string
     */
    public static function getSubraceCode()
    {
        return DarkElf::SUBRACE_CODE;
    }

}
