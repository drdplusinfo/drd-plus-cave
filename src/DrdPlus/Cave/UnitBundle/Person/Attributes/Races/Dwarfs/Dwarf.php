<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Dwarfs;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\RemarkableSenses\Touch;
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

    // base properties
    const BASE_STRENGTH = +1;
    const BASE_AGILITY = -1;
    const BASE_WILL = +2;
    const BASE_INTELLIGENCE = -1;
    const BASE_CHARISMA = -2;

    // derived
    const BASE_RESISTANCE = +1;
    const BASE_SENSES = -1;
    const BASE_TOUGHNESS = +1;

    // body
    const BASE_HEIGHT_IN_CM = 140.0;
    const BASE_WEIGHT_IN_KG = 70.0;

    /**
     * @return bool
     */
    public function hasInfravision()
    {
        return true;
    }
    /**
     * @return int
     */
    protected function getBaseSenses()
    {
        return static::BASE_SENSES;
    }

    public function getRemarkableSense()
    {
        return Touch::getIt();
    }
}
