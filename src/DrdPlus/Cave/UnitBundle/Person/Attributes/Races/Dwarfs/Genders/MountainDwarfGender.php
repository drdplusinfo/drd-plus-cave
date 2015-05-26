<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Dwarfs\Genders;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Dwarfs\MountainDwarf;

abstract class MountainDwarfGender extends DwarfGender {

    /**
     * @return string
     */
    public static function getSubraceCode()
    {
        return MountainDwarf::SUBRACE_CODE;
    }

}
