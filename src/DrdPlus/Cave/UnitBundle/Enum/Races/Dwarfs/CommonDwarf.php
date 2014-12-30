<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Dwarfs;

class CommonDwarf extends Dwarf
{
    const CODE = 'common-dwarf';

    /**
     * @return string
     */
    protected function getSubRaceCode()
    {
        return self::CODE;
    }
}
