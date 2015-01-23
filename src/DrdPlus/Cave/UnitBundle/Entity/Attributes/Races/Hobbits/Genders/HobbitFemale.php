<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Hobbits\Genders;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\IsFemaleTrait;

/**
 * HobbitFemale
 */
class HobbitFemale extends HobbitGender
{

    use IsFemaleTrait;

    /**
     * Get strength modifier
     *
     * @return int
     */
    public function getStrengthModifier()
    {
        return -1;
    }

    /**
     * Get agility modifier
     *
     * @return int
     */
    public function getAgilityModifier()
    {
        return +1;
    }

    /**
     * Get knack modifier
     *
     * @return int
     */
    public function getKnackModifier()
    {
        return -1;
    }

    /**
     * Get charisma modifier
     *
     * @return int
     */
    public function getCharismaModifier()
    {
        return +1;
    }

}
