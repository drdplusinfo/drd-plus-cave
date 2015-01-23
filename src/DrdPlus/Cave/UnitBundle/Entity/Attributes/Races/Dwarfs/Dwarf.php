<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Dwarfs;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Dwarfs\Genders\DwarfGender;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Race;

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
    const BASE_STRENGTH = +1;
    const BASE_AGILITY = -1;
    const BASE_WILL = +2;
    const BASE_INTELLIGENCE = -1;
    const BASE_CHARISMA = -2;
    const BASE_RESISTANCE = +1;
    const BASE_SENSES = -1;

    /**
     * @return string
     */
    public function getRaceCode()
    {
        return $this->getSubRaceCode();
    }

    /**
     * @return string
     */
    abstract public function getSubRaceCode();

    /**
     * @return bool
     */
    public function hasInfravision()
    {
        return true;
    }
}
