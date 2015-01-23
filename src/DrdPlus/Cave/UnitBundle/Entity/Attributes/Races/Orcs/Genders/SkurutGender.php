<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Orcs\Genders;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Orcs\Skurut;

abstract class SkurutGender extends OrcGender
{

    /**
     * @return string
     */
    public function getSubRaceCode()
    {
        return Skurut::SUBRACE_CODE;
    }

}
