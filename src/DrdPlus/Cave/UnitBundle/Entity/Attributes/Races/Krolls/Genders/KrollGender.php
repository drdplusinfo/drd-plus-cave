<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Krolls\Genders;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Gender;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Krolls\Kroll;

abstract class KrollGender extends Gender {

    /**
     * @return string
     */
    public static function getRaceCode()
    {
        return Kroll::RACE_CODE;
    }

}
