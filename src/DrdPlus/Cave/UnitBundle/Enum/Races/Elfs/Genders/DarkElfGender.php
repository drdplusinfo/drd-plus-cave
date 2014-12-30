<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Elfs\Genders;

abstract class DarkElfGender extends ElfGender
{

    const CODE = 'dark-elf';

    /**
     * @return string
     */
    protected function getSubRaceCode()
    {
        return self::CODE;
    }

}
