<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Orcs\Genders;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Gender;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Orcs\Orc;

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
