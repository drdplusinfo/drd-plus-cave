<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Genders;

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