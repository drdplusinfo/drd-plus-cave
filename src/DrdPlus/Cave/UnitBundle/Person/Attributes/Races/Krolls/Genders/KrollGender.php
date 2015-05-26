<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Krolls\Genders;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Gender;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Krolls\Kroll;

abstract class KrollGender extends Gender {

    /**
     * @return string
     */
    public static function getRaceCode()
    {
        return Kroll::RACE_CODE;
    }

}
