<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Humans\Genders;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Gender;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Humans\Human;

abstract class HumanGender extends Gender {

    /**
     * @return string
     */
    public function getRaceCode()
    {
        return Human::RACE_CODE;
    }

}
