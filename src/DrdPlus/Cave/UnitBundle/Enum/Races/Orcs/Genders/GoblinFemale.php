<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Orcs\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\IsFemale;

/**
 * GoblinFemale
 */
class GoblinFemale extends GoblinGender
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
     * Get will modifier
     *
     * @return int
     */
    public function getWillModifier()
    {
        return +1;
    }

}
