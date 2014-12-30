<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Orcs\Genders;

abstract class CommonOrcGender extends OrcGender
{

    const CODE = 'common-orc';

    /**
     * @return string
     */
    protected function getSubRaceCode()
    {
        return self::CODE;
    }

}
