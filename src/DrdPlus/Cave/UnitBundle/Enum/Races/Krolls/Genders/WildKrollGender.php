<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Krolls\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\Krolls\WildKroll;

abstract class WildKrollGender extends KrollGender {

    /**
     * @return string
     */
    protected function getSubRaceCode()
    {
        return WildKroll::CODE;
    }

}
