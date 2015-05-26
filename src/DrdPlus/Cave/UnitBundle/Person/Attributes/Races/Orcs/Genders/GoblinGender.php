<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Orcs\Genders;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Orcs\Goblin;

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
