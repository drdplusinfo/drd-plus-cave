<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races;

trait FemaleTrait
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

    /**
     * Every female is smaller then male, except dwarfs
     *
     * @return int
     */
    public function getSizeModifier()
    {
        return -1;
    }
}
