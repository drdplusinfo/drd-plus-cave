<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Elfs\Genders;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Elfs\CommonElf;

abstract class CommonElfGender extends ElfGender
{

    /**
     * @return string
     */
    public function getSubRaceCode()
    {
        return CommonElf::SUBRACE_CODE;
    }

}
