<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Humans\Genders;

abstract class CommonHumanGender extends HumanGender
{

    const CODE = 'common-human';

    /**
     * @return string
     */
    protected function getSubRaceCode()
    {
        return self::CODE;
    }

}
