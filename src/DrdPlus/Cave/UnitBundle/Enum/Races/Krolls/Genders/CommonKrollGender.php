<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Krolls\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\Krolls\CommonKroll;

abstract class CommonKrollGender extends KrollGender {

    /**
     * @return string
     */
    protected function getSubRaceCode() {
        return CommonKroll::CODE;
    }

}
