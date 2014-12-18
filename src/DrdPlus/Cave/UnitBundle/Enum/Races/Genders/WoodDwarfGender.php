<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\WoodDwarf;

abstract class WoodDwarfGender extends Gender {

    /**
     * @return string
     */
    protected function getRaceCode()
    {
        return WoodDwarf::CODE;
    }

}
