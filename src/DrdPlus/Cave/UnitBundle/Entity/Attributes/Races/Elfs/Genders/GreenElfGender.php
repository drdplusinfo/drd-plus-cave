<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Elfs\Genders;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Elfs\GreenElf;

abstract class GreenElfGender extends ElfGender {

    /**
     * @return string
     */
    public function getSubRaceCode()
    {
        return GreenElf::SUBRACE_CODE;
    }

}
