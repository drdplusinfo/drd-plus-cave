<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Dwarfs\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\IsFemale;

/**
 * CommonDwarfFemale
 */
class CommonDwarfFemale extends CommonDwarfGender
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
