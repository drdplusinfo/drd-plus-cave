<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\Orc;

abstract class OrcGender extends Gender
{

    /**
     * @return string
     */
    protected function getRaceCode()
    {
        return Orc::CODE;
    }

}
