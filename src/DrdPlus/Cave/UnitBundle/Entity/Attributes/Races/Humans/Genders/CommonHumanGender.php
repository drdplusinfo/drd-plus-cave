<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Humans\Genders;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Humans\CommonHuman;

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
