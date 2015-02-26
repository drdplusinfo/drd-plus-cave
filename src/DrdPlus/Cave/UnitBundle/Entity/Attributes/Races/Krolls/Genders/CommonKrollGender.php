<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Krolls\Genders;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Krolls\CommonKroll;

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
