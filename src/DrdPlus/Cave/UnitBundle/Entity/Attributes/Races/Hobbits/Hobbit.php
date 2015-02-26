<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Hobbits;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Race;

/**
 * Hobbit
 * @method int getStrengthModifier(Genders\HobbitGender $hobbitGender),
 * @see Race::getStrengthModifier
 * @method int getAgilityModifier(Genders\HobbitGender $hobbitGender)
 * @see Race::getAgilityModifier
 * @method int getKnackModifier(Genders\HobbitGender $hobbitGender)
 * @see Race::getKnackModifier
 * @method int getWillModifier(Genders\HobbitGender $hobbitGender)
 * @see Race::getWillModifier
 * @method int getIntelligenceModifier(Genders\HobbitGender $hobbitGender)
 * @see Race::getIntelligenceModifier
 * @method int getCharismaModifier(Genders\HobbitGender $hobbitGender)
 * @see Race::getCharismaModifier
 * @method int getResistanceModifier(Genders\HobbitGender $hobbitGender)
 * @see Race::getResistanceModifier
 * @method int getSensesModifier(Genders\HobbitGender $hobbitGender)
 * @see Race::getSensesModifier
 */
abstract class Hobbit extends Race
{
    const RACE_CODE = 'hobbit';

    const BASE_STRENGTH = -3;
    const BASE_AGILITY = +1;
    const BASE_KNACK = +1;
    const BASE_INTELLIGENCE = -1;
    const BASE_CHARISMA = +2;

    /**
     * @return string
     */
    public static function getRaceCode()
    {
        return self::RACE_CODE;
    }

}
