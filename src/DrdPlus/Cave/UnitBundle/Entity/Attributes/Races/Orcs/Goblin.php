<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Orcs;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Orcs\Genders\GoblinGender;

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

    const BASE_STRENGTH = -1;
    const BASE_KNACK = +1;
    const BASE_WILL = -2;
    const BASE_CHARISMA = -1;

    /**
     * @return string
     */
    public static function getSubraceCode()
    {
        return self::SUBRACE_CODE;
    }
}
