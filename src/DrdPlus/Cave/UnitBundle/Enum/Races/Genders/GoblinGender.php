<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\Goblin;

abstract class GoblinGender extends Gender {

    /**
     * @return string
     */
    protected function getRaceCode()
    {
        return Goblin::CODE;
    }

}
