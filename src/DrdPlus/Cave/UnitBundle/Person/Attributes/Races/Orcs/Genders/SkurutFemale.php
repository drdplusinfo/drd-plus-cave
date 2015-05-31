<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Orcs\Genders;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\FemaleTrait;

/**
 * SkurutFemale
 */
class SkurutFemale extends SkurutGender
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
