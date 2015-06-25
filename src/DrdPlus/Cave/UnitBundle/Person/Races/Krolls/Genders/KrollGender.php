<?php
namespace DrdPlus\Cave\UnitBundle\Person\Races\Krolls\Genders;

use DrdPlus\Cave\UnitBundle\Person\Races\Gender;
use DrdPlus\Cave\UnitBundle\Person\Races\Krolls\Kroll;

abstract class KrollGender extends Gender {

    /**
     * @return string
     */
    public static function getRaceCode()
    {
        return Kroll::RACE_CODE;
    }

}
