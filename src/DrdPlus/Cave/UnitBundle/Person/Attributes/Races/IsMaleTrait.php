<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races;

trait IsMaleTrait
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
