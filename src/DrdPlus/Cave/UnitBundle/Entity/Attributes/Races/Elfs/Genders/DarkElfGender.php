<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Elfs\Genders;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Elfs\DarkElf;

abstract class DarkElfGender extends ElfGender
{

    /**
     * @return string
     */
    public function getSubraceCode()
    {
        return DarkElf::SUBRACE_CODE;
    }

}
