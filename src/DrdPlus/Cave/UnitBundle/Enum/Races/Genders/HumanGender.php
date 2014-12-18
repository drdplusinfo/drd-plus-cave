<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\Human;

abstract class HumanGender extends Gender {

    /**
     * @return string
     */
    protected function getRaceCode()
    {
        return Human::CODE;
    }

}
