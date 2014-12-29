<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Orcs\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\Orcs\CommonOrc;

abstract class CommonOrcGender extends OrcGender
{

    /**
     * @return string
     */
    protected function getSubRaceCode()
    {
        return CommonOrc::CODE;
    }

}
