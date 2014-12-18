<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\GreenElf;

abstract class GreenElfGender extends Gender {

    /**
     * @return string
     */
    protected function getRaceCode()
    {
        return GreenElf::CODE;
    }

}
