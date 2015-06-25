<?php
namespace DrdPlus\Cave\UnitBundle\Person\Races\Orcs\Genders;

use DrdPlus\Cave\UnitBundle\Person\Races\FemaleTrait;

/**
 * CommonOrcFemale
 */
class CommonOrcFemale extends CommonOrcGender
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
