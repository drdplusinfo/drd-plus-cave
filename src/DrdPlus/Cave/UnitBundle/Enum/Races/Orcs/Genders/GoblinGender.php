<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Orcs\Genders;

abstract class GoblinGender extends OrcGender
{

    const CODE = 'goblin';

    /**
     * @return string
     */
    protected function getSubRaceCode()
    {
        return self::CODE;
    }

}
