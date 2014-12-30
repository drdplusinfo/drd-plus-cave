<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Elfs\Genders;

abstract class CommonElfGender extends ElfGender
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
