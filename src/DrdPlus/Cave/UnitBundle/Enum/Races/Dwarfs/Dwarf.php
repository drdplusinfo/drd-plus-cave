<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Dwarfs;

use DrdPlus\Cave\UnitBundle\Enum\Races\Genders\DwarfGender;
use DrdPlus\Cave\UnitBundle\Enum\Races\Race;

/**
 * Dwarf
 */
abstract class Dwarf extends Race
{
    const BASE_STRENGTH = +1;
    const BASE_AGILITY = -1;
    const BASE_KNACK = 0;
    const BASE_WILL = +2;
    const BASE_INTELLIGENCE = -1;
    const BASE_CHARISMA = -2;
    const BASE_RESISTANCE = +1;
    const BASE_SENSES = -1;

    /**
     * Get strength modifier
     *
     * @param DwarfGender $dwarfGender
     * @return int
     */
    public function getStrengthModifier(DwarfGender $dwarfGender)
    {
        return parent::getStrengthModifier($dwarfGender);
    }

    /**
     * @return int
     */
    protected function getBaseStrength() {
        return self::BASE_STRENGTH;
    }

    /**
     * Get agility modifier
     *
     * @param DwarfGender $dwarfGender
     * @return int
     */
    public function getAgilityModifier(DwarfGender $dwarfGender)
    {
        return parent::getAgilityModifier($dwarfGender);
    }

    /**
     * @return int
     */
    protected function getBaseAgility()
    {
        return self::BASE_AGILITY;
    }

    /**
     * Get knack modifier
     *
     * @param DwarfGender $dwarfGender
     * @return int
     */
    public function getKnackModifier(DwarfGender $dwarfGender)
    {
        return parent::getKnackModifier($dwarfGender);
    }

    /**
     * @return int
     */
    protected function getBaseKnack()
    {
        return self::BASE_KNACK;
    }

    /**
     * Get will modifier
     *
     * @param DwarfGender $dwarfGender
     * @return int
     */
    public function getWillModifier(DwarfGender $dwarfGender)
    {
        return parent::getWillModifier($dwarfGender);
    }

    /**
     * @return int
     */
    protected function getBaseWill()
    {
        return self::BASE_WILL;
    }

    /**
     * Get intelligence modifier
     *
     * @param DwarfGender $dwarfGender
     * @return int
     */
    public function getIntelligenceModifier(DwarfGender $dwarfGender)
    {
        return parent::getIntelligenceModifier($dwarfGender);
    }

    /**
     * @return int
     */
    protected function getBaseIntelligence()
    {
        return self::BASE_INTELLIGENCE;
    }

    /**
     * Get charisma modifier
     *
     * @param DwarfGender $dwarfGender
     * @return int
     */
    public function getCharismaModifier(DwarfGender $dwarfGender)
    {
        return parent::getCharismaModifier($dwarfGender);
    }

    /**
     * @return int
     */
    protected function getBaseCharisma()
    {
        return self::BASE_CHARISMA;
    }

    /**
     * Get resistance modifier
     *
     * @param DwarfGender $dwarfGender
     * @return int
     */
    public function getResistanceModifier(DwarfGender $dwarfGender)
    {
        return parent::getResistanceModifier($dwarfGender);
    }

    /**
     * @return int
     */
    protected function getBaseResistance()
    {
        return self::BASE_RESISTANCE;
    }

    /**
     * Get senses modifier
     *
     * @param DwarfGender $dwarfGender
     * @return int
     */
    public function getSensesModifier(DwarfGender $dwarfGender)
    {
        return parent::getSensesModifier($dwarfGender);
    }

    /**
     * @return int
     */
    protected function getBaseSenses()
    {
        return self::BASE_SENSES;
    }

    /**
     * @return bool
     */
    public function hasInfravision()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function hasNaturalRegeneration()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function requiresDungeonMasterAgreement()
    {
        return false;
    }
}
