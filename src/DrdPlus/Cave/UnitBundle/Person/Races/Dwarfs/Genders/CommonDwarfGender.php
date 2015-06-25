<?php
namespace DrdPlus\Cave\UnitBundle\Person\Races\Dwarfs\Genders;

use DrdPlus\Cave\UnitBundle\Person\Races\Dwarfs\CommonDwarf;

abstract class CommonDwarfGender extends DwarfGender
{

    /**
     * @return string
     */
    public static function getSubraceCode()
    {
        return CommonDwarf::SUBRACE_CODE;
    }

}
