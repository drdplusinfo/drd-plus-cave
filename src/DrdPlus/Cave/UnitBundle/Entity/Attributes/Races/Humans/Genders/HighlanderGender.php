<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Humans\Genders;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Humans\Highlander;

abstract class HighlanderGender extends HumanGender
{

    /**
     * @return string
     */
    public static function getSubraceCode()
    {
        return Highlander::SUBRACE_CODE;
    }

}
