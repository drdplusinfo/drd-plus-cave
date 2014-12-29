<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Orcs\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\Gender;

abstract class OrcGender extends Gender
{

    /**
     * @return string
     */
    protected function getRaceCode()
    {
        return $this->getSubRaceCode();
    }

    /**
     * @return string
     */
    abstract protected function getSubRaceCode();

}
