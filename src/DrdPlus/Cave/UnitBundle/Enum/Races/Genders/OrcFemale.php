<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Genders;

/**
 * OrcFemale
 */
class OrcFemale extends Female
{
    /**
     * Get strength modifier
     *
     * @return integer
     */
    public function getStrengthModifier()
    {
        return -1;
    }

    /**
     * Get will modifier
     *
     * @return integer
     */
    public function getWillModifier()
    {
        return +1;
    }

}
