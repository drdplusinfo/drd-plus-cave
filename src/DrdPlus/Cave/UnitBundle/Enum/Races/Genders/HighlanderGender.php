<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\Highlander;

abstract class HighlanderGender extends Gender {

    /**
     * @return string
     */
    protected function getRaceCode()
    {
        return Highlander::CODE;
    }

}
