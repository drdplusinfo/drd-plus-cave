<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Hobbits\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\Hobbits\CommonHobbit;

abstract class CommonHobbitGender extends HobbitGender {

    /**
     * @return string
     */
    protected function getSubRaceCode()
    {
        return CommonHobbit::CODE;
    }

}
