<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Elfs\Genders;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\IsFemaleTrait;

/**
 * CommonElfFemale
 */
class CommonElfFemale extends CommonElfGender
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
     * Get knack modifier
     *
     * @return int
     */
    public function getKnackModifier()
    {
        return +1;
    }

    /**
     * Get intelligence modifier
     *
     * @return int
     */
    public function getIntelligenceModifier()
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
