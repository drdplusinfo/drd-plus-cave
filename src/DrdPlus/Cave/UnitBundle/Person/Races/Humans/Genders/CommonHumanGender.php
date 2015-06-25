<?php
namespace DrdPlus\Cave\UnitBundle\Person\Races\Humans\Genders;

use DrdPlus\Cave\UnitBundle\Person\Races\Humans\CommonHuman;

abstract class CommonHumanGender extends HumanGender
{

    /**
     * @return string
     */
    public static function getSubraceCode()
    {
        return CommonHuman::SUBRACE_CODE;
    }

}
