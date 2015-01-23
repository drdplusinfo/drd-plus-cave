<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Dwarfs\Genders;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Dwarfs\CommonDwarf;

abstract class CommonDwarfGender extends DwarfGender
{

    /**
     * @return string
     */
    public function getSubRaceCode()
    {
        return CommonDwarf::CODE;
    }

}
