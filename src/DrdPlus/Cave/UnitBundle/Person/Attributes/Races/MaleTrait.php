<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races;

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
