<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Krolls\Genders;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Gender;

abstract class KrollGender extends Gender {

    /**
     * @return string
     */
    public function getRaceCode()
    {
        return $this->getSubRaceCode();
    }

    /**
     * @return string
     * TODO subrace and race code should be different and separated
     */
    abstract public function getSubRaceCode();

}
