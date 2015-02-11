<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Dwarfs\Genders;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Dwarfs\MountainDwarf;

abstract class MountainDwarfGender extends DwarfGender {

    /**
     * @return string
     */
    public function getSubraceCode()
    {
        return MountainDwarf::SUBRACE_CODE;
    }

}