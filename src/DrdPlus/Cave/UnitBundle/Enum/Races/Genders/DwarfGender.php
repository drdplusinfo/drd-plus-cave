<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\Dwarf;

abstract class DwarfGender extends Gender {

    /**
     * @return string
     */
    protected function getRaceCode()
    {
        return Dwarf::CODE;
    }

}
