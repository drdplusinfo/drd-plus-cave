<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\MountainDwarf;

abstract class MountainDwarfGender extends Gender {

    /**
     * @return string
     */
    protected function getRaceCode()
    {
        return MountainDwarf::CODE;
    }

}
