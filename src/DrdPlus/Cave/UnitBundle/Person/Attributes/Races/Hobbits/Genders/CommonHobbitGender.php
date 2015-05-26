<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Hobbits\Genders;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Hobbits\CommonHobbit;

abstract class CommonHobbitGender extends HobbitGender
{
    /**
     * @return string
     */
    public static function getSubraceCode()
    {
        return CommonHobbit::SUBRACE_CODE;
    }

}
