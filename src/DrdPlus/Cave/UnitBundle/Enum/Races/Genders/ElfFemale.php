<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Genders;

/**
 * ElfFemale
 */
class ElfFemale extends Female
{
    /**
     * Get strength modifier
     *
     * @return integer
     */
    public function getStrengthModifier()
    {
        return -1;
    }

    /**
     * Get knack modifier
     *
     * @return integer
     */
    public function getKnackModifier()
    {
        return +1;
    }

    /**
     * Get intelligence modifier
     *
     * @return integer
     */
    public function getIntelligenceModifier()
    {
        return -1;
    }

    /**
     * Get charisma modifier
     *
     * @return integer
     */
    public function getCharismaModifier()
    {
        return +1;
    }

}
