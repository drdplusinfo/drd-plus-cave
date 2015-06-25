<?php
namespace DrdPlus\Cave\UnitBundle\Person\Races\Krolls\Genders;

use DrdPlus\Cave\UnitBundle\Person\Races\Krolls\WildKroll;

abstract class WildKrollGender extends KrollGender
{

    /**
     * @return string
     */
    public static function getSubraceCode()
    {
        return WildKroll::SUBRACE_CODE;
    }
}
