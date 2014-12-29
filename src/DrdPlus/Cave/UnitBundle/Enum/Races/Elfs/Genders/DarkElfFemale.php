<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Elfs\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\IsFemale;

class DarkElfFemale extends DarkElfGender
{

    use IsFemale;

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
