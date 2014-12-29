<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Humans\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\Humans\Highlander;

abstract class HighlanderGender extends HumanGender {

    /**
     * @return string
     */
    protected function getSubRaceCode()
    {
        return Highlander::CODE;
    }

}
