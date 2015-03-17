<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes\Races\Helpers;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Gender;

class SubraceGenderWithAmbiguousGenderDetection extends Gender
{

    public static function getRaceCode()
    {
        return 'ambiguous';
    }

    public static function getSubraceCode()
    {
        return 'detection';
    }

    /**
     * @return bool
     */
    public static function isMale()
    {
        return true;
    }

    /**
     * @return bool
     */
    public static function isFemale()
    {
        return true;
    }

}
