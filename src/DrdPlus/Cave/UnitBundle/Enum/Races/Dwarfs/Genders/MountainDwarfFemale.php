<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Dwarfs\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\IsFemaleTrait;

/**
 * MountainDwarfFemale
 */
class MountainDwarfFemale extends MountainDwarfGender
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
