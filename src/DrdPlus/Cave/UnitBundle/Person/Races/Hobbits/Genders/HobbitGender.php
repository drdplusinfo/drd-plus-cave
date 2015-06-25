<?php
namespace DrdPlus\Cave\UnitBundle\Person\Races\Hobbits\Genders;

use DrdPlus\Cave\UnitBundle\Person\Races\Gender;
use DrdPlus\Cave\UnitBundle\Person\Races\Hobbits\Hobbit;

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
