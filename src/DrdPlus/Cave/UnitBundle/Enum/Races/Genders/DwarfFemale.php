<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Genders;

/**
 * DwarfFemale
 */
class DwarfFemale extends Female
{
    /**
     * Get knack modifier
     *
     * @return integer
     */
    public function getKnackModifier()
    {
        return -1;
    }

    /**
     * Get intelligence modifier
     *
     * @return integer
     */
    public function getIntelligenceModifier()
    {
        return +1;
    }

}
