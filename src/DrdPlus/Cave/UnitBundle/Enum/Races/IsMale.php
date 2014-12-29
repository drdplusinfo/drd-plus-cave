<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races;

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
