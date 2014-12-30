<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Hobbits\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\Gender;

abstract class HobbitGender extends Gender
{

    const CODE = 'hobbit';

    /**
     * @return string
     */
    protected function getRaceCode()
    {
        return self::CODE;
    }

}
