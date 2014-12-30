<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Elfs\Genders;

abstract class GreenElfGender extends ElfGender {

    const CODE = 'green-elf';

    /**
     * @return string
     */
    protected function getSubRaceCode()
    {
        return self::CODE;
    }

}
