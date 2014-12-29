<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Dwarfs\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\Dwarfs\WoodDwarf;

abstract class WoodDwarfGender extends DwarfGender
{

    /**
     * @return string
     */
    protected function getSubRaceCode()
    {
        return WoodDwarf::CODE;
    }

}
