<?php
namespace DrdPlus\Cave\UnitBundle\Person\Races\Krolls\Genders;

use DrdPlus\Cave\UnitBundle\Person\Races\FemaleTrait;

/**
 * WildKrollFemale
 */
class WildKrollFemale extends WildKrollGender
{

    use FemaleTrait;

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
