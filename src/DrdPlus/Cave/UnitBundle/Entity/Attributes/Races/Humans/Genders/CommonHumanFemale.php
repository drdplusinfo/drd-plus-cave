<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Humans\Genders;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\IsFemaleTrait;

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
