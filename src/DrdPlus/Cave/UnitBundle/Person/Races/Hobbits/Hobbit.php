<?php
namespace DrdPlus\Cave\UnitBundle\Person\Races\Hobbits;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\RemarkableSenses\Taste;
use DrdPlus\Cave\UnitBundle\Person\Races\Race;

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

    // body
    const BASE_STRENGTH = -3;
    const BASE_AGILITY = +1;
    const BASE_KNACK = +1;
    const BASE_INTELLIGENCE = -1;
    const BASE_CHARISMA = +2;

    // body
    const BASE_SIZE = -2;
    const BASE_HEIGHT_IN_CM = 110.0;
    const BASE_WEIGHT_IN_KG = 40.0;

    public function getRemarkableSense()
    {
        return Taste::getIt();
    }
}
