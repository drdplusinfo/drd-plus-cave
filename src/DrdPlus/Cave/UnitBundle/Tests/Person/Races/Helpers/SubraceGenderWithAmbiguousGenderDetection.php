<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Person\Races\Helpers;

use DrdPlus\Cave\UnitBundle\Person\Races\Gender;

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
