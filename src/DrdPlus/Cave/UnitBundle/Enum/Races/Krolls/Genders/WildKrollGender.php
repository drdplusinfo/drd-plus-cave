<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Krolls\Genders;

abstract class WildKrollGender extends KrollGender
{

    const CODE = 'wild-kroll';

    /**
     * @return string
     */
    protected function getSubRaceCode()
    {
        return self::CODE;
    }
}
