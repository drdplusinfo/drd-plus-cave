<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\Dwarfs\Genders\DwarfGender;
use DrdPlus\Cave\UnitBundle\Enum\Races\Dwarfs\MountainDwarf;

abstract class MountainDwarfGender extends DwarfGender {

    /**
     * @return string
     */
    protected function getSubRaceCode()
    {
        return MountainDwarf::CODE;
    }

}
