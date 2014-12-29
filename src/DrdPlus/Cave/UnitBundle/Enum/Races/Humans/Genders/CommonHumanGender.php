<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Humans\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\Humans\CommonHuman;

abstract class CommonHumanGender extends HumanGender {

    /**
     * @return string
     */
    protected function getSubRaceCode()
    {
        return CommonHuman::CODE;
    }

}
