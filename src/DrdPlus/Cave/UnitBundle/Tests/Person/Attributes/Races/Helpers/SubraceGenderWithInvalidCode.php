<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes\Races\Helpers;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Gender;

class SubraceGenderWithInvalidCode extends Gender
{
    private static $returnInvalidCode = false;

    public static function getRaceCode()
    {
        return 'baz';
    }

    public static function getSubraceCode()
    {
        return 'qux';
    }

    public static function returnInvalidCode()
    {
        self::$returnInvalidCode = true;
    }

    public static function getTypeName()
    {
        return parent::getRaceSubraceAndGenderCode();
    }

    /**
     * @return string
     */
    public static function getRaceSubraceAndGenderCode()
    {
        if (!self::$returnInvalidCode) {
            return parent::getRaceSubraceAndGenderCode();
        }

        return 'some invalid code';
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
