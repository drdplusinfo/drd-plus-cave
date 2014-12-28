<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Dwarfs;

class CommonDwarf extends Dwarf
{
    const CODE = 'dwarf';

    /**
     * @return string
     */
    protected function getRaceCode()
    {
        return self::CODE;
    }
}
