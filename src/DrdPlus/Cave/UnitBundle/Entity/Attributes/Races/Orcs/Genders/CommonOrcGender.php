<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Orcs\Genders;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Orcs\CommonOrc;

abstract class CommonOrcGender extends OrcGender
{

    /**
     * @return string
     */
    public function getSubRaceCode()
    {
        return CommonOrc::SUBRACE_CODE;
    }

}
