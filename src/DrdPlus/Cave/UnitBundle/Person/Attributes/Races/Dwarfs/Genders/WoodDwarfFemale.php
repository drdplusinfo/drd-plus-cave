<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Dwarfs\Genders;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\IsFemaleTrait;

/**
 * WoodDwarfFemale
 */
class WoodDwarfFemale extends WoodDwarfGender
{
    use IsFemaleTrait;

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
