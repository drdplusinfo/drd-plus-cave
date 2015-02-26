<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Orcs\Genders;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Orcs\Goblin;

abstract class GoblinGender extends OrcGender
{

    /**
     * @return string
     */
    public static function getSubraceCode()
    {
        return Goblin::SUBRACE_CODE;
    }

}
