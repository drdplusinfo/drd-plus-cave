<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Dwarfs\Genders;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Dwarfs\WoodDwarf;

abstract class WoodDwarfGender extends DwarfGender
{

    /**
     * @return string
     */
    public static function getSubraceCode()
    {
        return WoodDwarf::SUBRACE_CODE;
    }

}
