<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Elfs;

class CommonElf extends Elf
{
    const CODE = 'common-elf';

    /**
     * @return string
     */
    protected function getSubRaceCode()
    {
        return self::CODE;
    }
}
