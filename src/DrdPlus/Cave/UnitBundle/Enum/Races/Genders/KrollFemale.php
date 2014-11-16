<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Genders;

/**
 * KrollFemale
 */
class KrollFemale extends Female
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
     * Get agility modifier
     *
     * @return integer
     */
    public function getAgilityModifier()
    {
        return +1;
    }

    /**
     * Get will modifier
     *
     * @return integer
     */
    public function getWillModifier()
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
