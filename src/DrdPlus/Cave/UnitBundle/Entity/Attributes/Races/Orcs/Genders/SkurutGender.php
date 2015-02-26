<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Orcs\Genders;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Orcs\Skurut;

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
