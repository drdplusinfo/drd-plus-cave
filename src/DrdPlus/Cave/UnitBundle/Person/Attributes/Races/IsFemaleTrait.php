<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races;

trait IsFemaleTrait
{
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
        return true;
    }
}
