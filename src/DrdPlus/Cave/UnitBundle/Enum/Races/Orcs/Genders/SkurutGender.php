<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Orcs\Genders;

abstract class SkurutGender extends OrcGender
{

    const CODE = 'skurut';

    /**
     * @return string
     */
    protected function getSubRaceCode()
    {
        return self::CODE;
    }

}
