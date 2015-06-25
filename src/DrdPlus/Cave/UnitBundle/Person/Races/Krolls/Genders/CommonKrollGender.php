<?php
namespace DrdPlus\Cave\UnitBundle\Person\Races\Krolls\Genders;

use DrdPlus\Cave\UnitBundle\Person\Races\Krolls\CommonKroll;

abstract class CommonKrollGender extends KrollGender
{

    /**
     * @return string
     */
    public static function getSubraceCode()
    {
        return CommonKroll::SUBRACE_CODE;
    }

}
