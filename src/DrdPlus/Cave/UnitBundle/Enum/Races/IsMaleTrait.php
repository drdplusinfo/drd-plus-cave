<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races;

trait IsMaleTrait
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
