<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Hobbits;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Hobbits\Genders\HobbitGender;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Race;

/**
 * Hobbit
 * @method int getStrengthModifier(HobbitGender $hobbitGender),
 * @see Race::getStrengthModifier
 * @method int getAgilityModifier(HobbitGender $hobbitGender)
 * @see Race::getAgilityModifier
 * @method int getKnackModifier(HobbitGender $hobbitGender)
 * @see Race::getKnackModifier
 * @method int getWillModifier(HobbitGender $hobbitGender)
 * @see Race::getWillModifier
 * @method int getIntelligenceModifier(HobbitGender $hobbitGender)
 * @see Race::getIntelligenceModifier
 * @method int getCharismaModifier(HobbitGender $hobbitGender)
 * @see Race::getCharismaModifier
 * @method int getResistanceModifier(HobbitGender $hobbitGender)
 * @see Race::getResistanceModifier
 * @method int getSensesModifier(HobbitGender $hobbitGender)
 * @see Race::getSensesModifier
 */
class Hobbit extends Race
{
    const RACE_CODE = 'hobbit';
    // TODO make common hobbit to allow subraces to him
    const SUBRACE_CODE = 'hobbit';

    const BASE_STRENGTH = -3;
    const BASE_AGILITY = +1;
    const BASE_KNACK = +1;
    const BASE_INTELLIGENCE = -1;
    const BASE_CHARISMA = +2;

    /**
     * @return string
     */
    public function getRaceCode()
    {
        return self::RACE_CODE;
    }

    public function getSubraceCode()
    {
        return self::SUBRACE_CODE;
    }

}
