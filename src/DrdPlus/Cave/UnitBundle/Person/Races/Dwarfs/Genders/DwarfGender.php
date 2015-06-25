<?php
namespace DrdPlus\Cave\UnitBundle\Person\Races\Dwarfs\Genders;

use DrdPlus\Cave\UnitBundle\Person\Races\Dwarfs\Dwarf;
use DrdPlus\Cave\UnitBundle\Person\Races\Gender;

abstract class DwarfGender extends Gender {

    /**
     * @return string
     */
    public static function getRaceCode()
    {
        return Dwarf::RACE_CODE;
    }

}
