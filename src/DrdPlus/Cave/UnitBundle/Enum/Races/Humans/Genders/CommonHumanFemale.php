<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Humans\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Races\IsFemaleTrait;

/**
 * CommonHumanFemale
 */
class CommonHumanFemale extends CommonHumanGender
{

    use IsFemaleTrait;

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
