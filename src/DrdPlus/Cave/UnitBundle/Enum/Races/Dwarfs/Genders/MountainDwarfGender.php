<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Dwarfs\Genders;

abstract class MountainDwarfGender extends DwarfGender {

    const CODE = 'mountain-dwarf';

    /**
     * @return string
     */
    protected function getSubRaceCode()
    {
        return self::CODE;
    }

}
