<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\Skurut;

abstract class SkurutGender extends Gender {

    /**
     * @return string
     */
    protected function getRaceCode()
    {
        return Skurut::CODE;
    }

}
