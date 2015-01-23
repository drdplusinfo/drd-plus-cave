<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races;

trait IsFemaleTrait
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
