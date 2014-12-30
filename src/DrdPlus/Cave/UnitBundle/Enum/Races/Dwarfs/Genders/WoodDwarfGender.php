<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Dwarfs\Genders;

abstract class WoodDwarfGender extends DwarfGender
{

    const CODE = 'wood-dwarf';

    /**
     * @return string
     */
    protected function getSubRaceCode()
    {
        return self::CODE;
    }

}
