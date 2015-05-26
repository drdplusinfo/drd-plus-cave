<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Elfs\Genders;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Elfs\CommonElf;

abstract class CommonElfGender extends ElfGender
{

    /**
     * @return string
     */
    public static function getSubraceCode()
    {
        return CommonElf::SUBRACE_CODE;
    }

}
