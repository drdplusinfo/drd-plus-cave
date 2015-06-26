<?php
namespace DrdPlus\Cave\UnitBundle\Person\Races\Orcs;

use DrdPlus\Cave\UnitBundle\Person\Races\Orcs\Genders\GoblinGender;

/**
 * Goblin
 *
 * @method int getStrengthModifier(GoblinGender $goblinGender),
 * @see Race::getStrengthModifier
 * @method int getAgilityModifier(GoblinGender $goblinGender)
 * @see Race::getAgilityModifier
 * @method int getKnackModifier(GoblinGender $goblinGender)
 * @see Race::getKnackModifier
 * @method int getWillModifier(GoblinGender $goblinGender)
 * @see Race::getWillModifier
 * @method int getIntelligenceModifier(GoblinGender $goblinGender)
 * @see Race::getIntelligenceModifier
 * @method int getCharismaModifier(GoblinGender $goblinGender)
 * @see Race::getCharismaModifier
 * @method int getResistanceModifier(GoblinGender $goblinGender)
 * @see Race::getResistanceModifier
 * @method int getSensesModifier(GoblinGender $goblinGender)
 * @see Race::getSensesModifier
 */
class Goblin extends Orc
{
    const SUBRACE_CODE = 'goblin';

    // base properties
    const BASE_STRENGTH = -1;
    const BASE_KNACK = +1;
    const BASE_WILL = -2;
    const BASE_CHARISMA = -1;

    // body
    const BASE_SIZE = -1;
    const BASE_HEIGHT_IN_CM = 150.0;
    const BASE_WEIGHT_IN_KG = 55.0;

}