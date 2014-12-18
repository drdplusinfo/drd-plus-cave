<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\Kroll;

abstract class KrollGender extends Gender {

    /**
     * @return string
     */
    protected function getRaceCode()
    {
        return Kroll::CODE;
    }

}
