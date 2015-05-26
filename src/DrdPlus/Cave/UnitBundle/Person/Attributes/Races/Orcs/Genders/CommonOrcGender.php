<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Orcs\Genders;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Orcs\CommonOrc;

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
