<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Genders;

/**
 * HumanFemale
 */
class HumanFemale extends HumanGender
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
     * Get charisma modifier
     *
     * @return int
     */
    public function getCharismaModifier()
    {
        return +1;
    }

}
