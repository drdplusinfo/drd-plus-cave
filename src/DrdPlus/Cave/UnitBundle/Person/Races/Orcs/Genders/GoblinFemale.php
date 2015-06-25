<?php
namespace DrdPlus\Cave\UnitBundle\Person\Races\Orcs\Genders;

use DrdPlus\Cave\UnitBundle\Person\Races\FemaleTrait;

/**
 * GoblinFemale
 */
class GoblinFemale extends GoblinGender
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
     * Get will modifier
     *
     * @return int
     */
    public function getWillModifier()
    {
        return +1;
    }

}
