<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Dwarfs\Genders;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Dwarfs\Dwarf;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Gender;

abstract class DwarfGender extends Gender {

    /**
     * @return string
     */
    public function getRaceCode()
    {
        return Dwarf::RACE_CODE;
    }

}
