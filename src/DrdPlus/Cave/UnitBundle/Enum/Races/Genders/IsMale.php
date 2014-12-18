<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Genders;

trait IsMale
{
    /**
     * @return bool
     */
    public function isMale()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isFemale()
    {
        return false;
    }
}
