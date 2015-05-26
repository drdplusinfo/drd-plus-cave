<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Dwarfs\Genders;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Dwarfs\Dwarf;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Gender;

abstract class DwarfGender extends Gender {

    /**
     * @return string
     */
    public static function getRaceCode()
    {
        return Dwarf::RACE_CODE;
    }

}
