<?php
namespace DrdPlus\Cave\UnitBundle\Person\Races\Humans\Genders;

use DrdPlus\Cave\UnitBundle\Person\Races\FemaleTrait;

/**
 * HighlanderFemale
 */
class HighlanderFemale extends HighlanderGender
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
     * Get charisma modifier
     *
     * @return int
     */
    public function getCharismaModifier()
    {
        return +1;
    }

}
