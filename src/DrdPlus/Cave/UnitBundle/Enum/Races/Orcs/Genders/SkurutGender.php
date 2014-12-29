<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Orcs\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\Orcs\Skurut;

abstract class SkurutGender extends OrcGender {

    /**
     * @return string
     */
    protected function getSubRaceCode()
    {
        return Skurut::CODE;
    }

}
