<?php
namespace DrdPlus\Cave\UnitBundle\Person\Races\Dwarfs\Genders;

use DrdPlus\Cave\UnitBundle\Person\Races\FemaleTrait;

/**
 * WoodDwarfFemale
 */
class WoodDwarfFemale extends WoodDwarfGender
{
    use FemaleTrait;

    /**
     * Get knack modifier
     *
     * @return int
     */
    public function getKnackModifier()
    {
        return -1;
    }

    /**
     * Get intelligence modifier
     *
     * @return int
     */
    public function getIntelligenceModifier()
    {
        return +1;
    }

}
