<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Person\Races\Helpers;

use DrdPlus\Cave\UnitBundle\Person\Races\Gender;

class SubraceGenderWithUnknownGenderDetection extends Gender
{

    public static function getRaceCode()
    {
        return 'unknown';
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
        return false;
    }

    /**
     * @return bool
     */
    public static function isFemale()
    {
        return false;
    }

}
