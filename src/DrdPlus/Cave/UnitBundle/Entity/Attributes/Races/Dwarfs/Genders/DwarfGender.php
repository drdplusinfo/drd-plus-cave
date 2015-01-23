<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Dwarfs\Genders;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Gender;

abstract class DwarfGender extends Gender {

    /**
     * @return string
     */
    public function getRaceCode()
    {
        return $this->getSubRaceCode();
    }

    /**
     * @return string
     */
    abstract public function getSubRaceCode();

}
