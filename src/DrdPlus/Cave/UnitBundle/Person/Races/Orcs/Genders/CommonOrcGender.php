<?php
namespace DrdPlus\Cave\UnitBundle\Person\Races\Orcs\Genders;

use DrdPlus\Cave\UnitBundle\Person\Races\Orcs\CommonOrc;

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
