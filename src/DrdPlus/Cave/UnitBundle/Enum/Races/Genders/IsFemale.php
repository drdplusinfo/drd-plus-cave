<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Genders;

trait IsFemale
{
    /**
     * @return bool
     */
    public function isMale()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isFemale()
    {
        return true;
    }
}
