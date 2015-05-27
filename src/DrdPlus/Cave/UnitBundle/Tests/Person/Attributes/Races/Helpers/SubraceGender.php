<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Person\Attributes\Races\Helpers;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Gender;

class SubraceGender extends Gender
{
    /**
     * @return string
     */
    public static function getRaceCode()
    {
        return 'foo';
    }

    /**
     * @return string
     */
    public static function getSubraceCode()
    {
        return 'bar';
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
        return false;
    }

}
