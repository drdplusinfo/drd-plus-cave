<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Genders;

/**
 * HobbitFemale
 */
class HobbitFemale extends Female
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
     * Get knack modifier
     *
     * @return integer
     */
    public function getKnackModifier()
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
