<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Orcs\Genders;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Gender;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Orcs\Orc;

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
