<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Hobbits\Genders;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Gender;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Hobbits\Hobbit;

abstract class HobbitGender extends Gender
{

    /**
     * @return string
     */
    public function getRaceCode()
    {
        return Hobbit::CODE;
    }

}
