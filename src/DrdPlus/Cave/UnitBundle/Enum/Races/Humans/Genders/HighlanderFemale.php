<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Humans\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\IsFemale;

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
