<?php
namespace DrdPlus\Cave\UnitBundle\Person\Races\Humans\Genders;

use DrdPlus\Cave\UnitBundle\Person\Races\Gender;
use DrdPlus\Cave\UnitBundle\Person\Races\Humans\Human;

abstract class HumanGender extends Gender {

    /**
     * @return string
     */
    public static function getRaceCode()
    {
        return Human::RACE_CODE;
    }

}
