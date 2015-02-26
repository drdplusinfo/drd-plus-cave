<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Orcs\Genders;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Orcs\CommonOrc;

abstract class CommonOrcGender extends OrcGender
{

    /**
     * @return string
     */
    public static function getSubraceCode()
    {
        return CommonOrc::SUBRACE_CODE;
    }

}
