<?php
namespace DrdPlus\Cave\UnitBundle\Person\Races\Orcs\Genders;

use DrdPlus\Cave\UnitBundle\Person\Races\Gender;
use DrdPlus\Cave\UnitBundle\Person\Races\Orcs\Orc;

abstract class OrcGender extends Gender
{

    /**
     * @return string
     */
    public static function getRaceCode()
    {
        return Orc::RACE_CODE;
    }

}
