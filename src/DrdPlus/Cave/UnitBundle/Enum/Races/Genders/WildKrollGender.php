<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\WildKroll;

abstract class WildKrollGender extends Gender {

    /**
     * @return string
     */
    protected function getRaceCode()
    {
        return WildKroll::CODE;
    }

}
