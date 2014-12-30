<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Humans\Genders;

abstract class HighlanderGender extends HumanGender
{

    const CODE = 'highlander';

    /**
     * @return string
     */
    protected function getSubRaceCode()
    {
        return self::CODE;
    }

}
