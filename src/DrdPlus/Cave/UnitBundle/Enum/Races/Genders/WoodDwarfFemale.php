<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Genders;

/**
 * WoodDwarfFemale
 */
class WoodDwarfFemale extends WoodDwarfGender
{
    use IsFemale;

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
