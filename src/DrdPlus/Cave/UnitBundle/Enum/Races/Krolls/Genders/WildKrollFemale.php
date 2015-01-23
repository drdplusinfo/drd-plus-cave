<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Krolls\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\IsFemaleTrait;

/**
 * WildKrollFemale
 */
class WildKrollFemale extends WildKrollGender
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
     * Get will modifier
     *
     * @return int
     */
    public function getWillModifier()
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
