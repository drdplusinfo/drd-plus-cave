<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races;

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
