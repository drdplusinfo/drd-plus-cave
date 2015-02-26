<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Elfs;

class CommonElf extends Elf
{
    const SUBRACE_CODE = 'common-elf';

    /**
     * @return string
     */
    public static function getSubRaceCode()
    {
        return self::SUBRACE_CODE;
    }
}
