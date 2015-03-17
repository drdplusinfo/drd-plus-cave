<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes\Races\Helpers;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Gender;

class SubraceGenderWithUnknownGenderDetection extends Gender
{

    public static function getRaceCode()
    {
        return 'invalid';
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
