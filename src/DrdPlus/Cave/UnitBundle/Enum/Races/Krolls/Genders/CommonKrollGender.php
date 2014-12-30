<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Krolls\Genders;

abstract class CommonKrollGender extends KrollGender
{

    const CODE = 'common-kroll';

    /**
     * @return string
     */
    protected function getSubRaceCode()
    {
        return self::CODE;
    }

}
