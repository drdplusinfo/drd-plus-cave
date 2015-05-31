<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Dwarfs;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Dwarfs\Genders\DwarfGender;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Race;

/**
 * Dwarf
 *
 * @method int getStrengthModifier(DwarfGender $dwarfGender),
 * @see Race::getStrengthModifier
 * @method int getAgilityModifier(DwarfGender $dwarfGender)
 * @see Race::getAgilityModifier
 * @method int getKnackModifier(DwarfGender $dwarfGender)
 * @see Race::getKnackModifier
 * @method int getWillModifier(DwarfGender $dwarfGender)
 * @see Race::getWillModifier
 * @method int getIntelligenceModifier(DwarfGender $dwarfGender)
 * @see Race::getIntelligenceModifier
 * @method int getCharismaModifier(DwarfGender $dwarfGender)
 * @see Race::getCharismaModifier
 * @method int getResistanceModifier(DwarfGender $dwarfGender)
 * @see Race::getResistanceModifier
 * @method int getSensesModifier(DwarfGender $dwarfGender)
 * @see Race::getSensesModifier
 */
abstract class Dwarf extends Race
{
    const RACE_CODE = 'dwarf';

    const BASE_STRENGTH = +1;
    const BASE_AGILITY = -1;
    const BASE_WILL = +2;
    const BASE_INTELLIGENCE = -1;
    const BASE_CHARISMA = -2;
    const BASE_RESISTANCE = +1;
    const BASE_SENSES = -1;
    const BASE_TOUGHNESS = +1;
    const BASE_HEIGHT_IN_CM = 140.0;
    const BASE_HEIGHT = 3; // 140 cm, see table of distance -> to bonus
    const BASE_WEIGHT = +5;
    const BASE_WEIGHT_IN_KG = 70.0;

    /**
     * @return bool
     */
    public function hasInfravision()
    {
        return true;
    }

    public function getSalientSense()
    {
        return self::SALIENT_TOUCH;
    }
}
