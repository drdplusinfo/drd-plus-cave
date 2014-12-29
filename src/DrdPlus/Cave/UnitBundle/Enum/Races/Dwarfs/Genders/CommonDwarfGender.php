<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Dwarfs\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\Dwarfs\CommonDwarf;

abstract class CommonDwarfGender extends DwarfGender {

    /**
     * @return string
     */
    protected function getSubRaceCode()
    {
        return CommonDwarf::CODE;
    }

}
