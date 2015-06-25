<?php
namespace DrdPlus\Cave\UnitBundle\Person\Races\Orcs\Genders;

use DrdPlus\Cave\UnitBundle\Person\Races\Orcs\Skurut;

abstract class SkurutGender extends OrcGender
{

    /**
     * @return string
     */
    public static function getSubraceCode()
    {
        return Skurut::SUBRACE_CODE;
    }

}
