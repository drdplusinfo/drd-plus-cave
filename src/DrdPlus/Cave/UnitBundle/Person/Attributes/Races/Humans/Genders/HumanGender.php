<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Humans\Genders;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Gender;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Humans\Human;

abstract class HumanGender extends Gender {

    /**
     * @return string
     */
    public static function getRaceCode()
    {
        return Human::RACE_CODE;
    }

}
