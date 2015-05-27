<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Person\Attributes\Races\Helpers;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Gender;

class SubraceGenderWithoutFemaleDetection extends Gender
{

    public static function getRaceCode()
    {
        return 'detection';
    }

    public static function getSubraceCode()
    {
        return 'of_female';
    }

    /**
     * @return bool
     */
    public static function isMale()
    {
        return true;
    }

}
