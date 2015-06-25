<?php
namespace DrdPlus\Cave\UnitBundle\Person\Races\Dwarfs\Genders;

use DrdPlus\Cave\UnitBundle\Person\Races\FemaleTrait;

/**
 * MountainDwarfFemale
 */
class MountainDwarfFemale extends MountainDwarfGender
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
