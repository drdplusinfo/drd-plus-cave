<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Dwarfs\Genders;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\FemaleTrait;

/**
 * CommonDwarfFemale
 */
class CommonDwarfFemale extends CommonDwarfGender
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

    public function getSizeModifier()
    {
        return +0;
    }

}
