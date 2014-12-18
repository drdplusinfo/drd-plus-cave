<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\Hobbit;

abstract class HobbitGender extends Gender {

    /**
     * @return string
     */
    protected function getRaceCode()
    {
        return Hobbit::CODE;
    }

}
