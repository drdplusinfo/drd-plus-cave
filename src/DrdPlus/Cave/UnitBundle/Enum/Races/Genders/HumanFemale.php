<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Genders;

/**
 * HumanFemale
 */
class HumanFemale extends Female
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
     * Get charisma modifier
     *
     * @return integer
     */
    public function getCharismaModifier()
    {
        return +1;
    }

}
