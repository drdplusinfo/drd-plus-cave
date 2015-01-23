<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Krolls\Genders;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Krolls\WildKroll;

abstract class WildKrollGender extends KrollGender
{

    /**
     * @return string
     */
    public function getSubRaceCode()
    {
        return WildKroll::SUBRACE_CODE;
    }
}
