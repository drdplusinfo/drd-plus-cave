<?php
namespace DrdPlus\Cave\UnitBundle\Person\Races;

trait MaleTrait
{
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
