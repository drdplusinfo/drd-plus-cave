<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes\Races\Helpers;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Gender;

class SubraceGenderWithoutSubraceCode extends Gender
{

    public static function getRaceCode()
    {
        return 'without';
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
