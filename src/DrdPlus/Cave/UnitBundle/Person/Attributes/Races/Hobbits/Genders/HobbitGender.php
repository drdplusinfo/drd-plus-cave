<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Hobbits\Genders;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Gender;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Hobbits\Hobbit;

abstract class HobbitGender extends Gender
{
    /**
     * @return string
     */
    public static function getRaceCode()
    {
        return Hobbit::RACE_CODE;
    }

}
