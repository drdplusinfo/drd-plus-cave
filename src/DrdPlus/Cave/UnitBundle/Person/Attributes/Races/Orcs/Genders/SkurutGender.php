<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Orcs\Genders;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Orcs\Skurut;

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
