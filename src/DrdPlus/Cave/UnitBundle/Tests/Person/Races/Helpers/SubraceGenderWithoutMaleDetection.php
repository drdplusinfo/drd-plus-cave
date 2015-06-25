<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Person\Races\Helpers;

use DrdPlus\Cave\UnitBundle\Person\Races\Gender;

class SubraceGenderWithoutMaleDetection extends Gender
{

    public static function getRaceCode()
    {
        return 'male';
    }

    public static function getSubraceCode()
    {
        return 'detection';
    }

    /**
     * @return bool
     */
    public static function isFemale()
    {
        return true;
    }

}
