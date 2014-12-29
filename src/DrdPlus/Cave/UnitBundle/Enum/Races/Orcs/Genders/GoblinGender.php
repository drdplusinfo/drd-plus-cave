<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Orcs\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\Orcs\Goblin;

abstract class GoblinGender extends OrcGender {

    /**
     * @return string
     */
    protected function getSubRaceCode()
    {
        return Goblin::CODE;
    }

}
