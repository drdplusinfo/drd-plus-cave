<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Genders;

/**
 * HighlanderFemale
 */
class HighlanderFemale extends HighlanderGender
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
