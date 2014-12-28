<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Elfs;

use DrdPlus\Cave\UnitBundle\Enum\Races\Genders\DarkElfGender;

/**
 * DarkElf
 */
class DarkElf extends Elf
{
    const CODE = 'dark-elf';

    const BASE_STRENGTH = 0;
    const BASE_AGILITY = 0;
    const BASE_KNACK = 0;
    const BASE_WILL = 0;
    const BASE_INTELLIGENCE = +1;
    const BASE_CHARISMA = 0;
    const BASE_RESISTANCE = 0;
    const BASE_SENSES = 0;

    /**
     * @return string
     */
    protected function getRaceCode()
    {
        return self::CODE;
    }

    /**
     * Get strength modifier
     *
     * @param DarkElfGender $darkElfGender
     * @return int
     */
    public function getStrengthModifier(DarkElfGender $darkElfGender)
    {
        return parent::getStrengthModifier($darkElfGender);
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
     * @param DarkElfGender $darkElfGender
     * @return int
     */
    public function getAgilityModifier(DarkElfGender $darkElfGender)
    {
        return parent::getAgilityModifier($darkElfGender);
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
     * @param DarkElfGender $darkElfGender
     * @return int
     */
    public function getKnackModifier(DarkElfGender $darkElfGender)
    {
        return parent::getKnackModifier($darkElfGender);
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
     * @param DarkElfGender $darkElfGender
     * @return int
     */
    public function getWillModifier(DarkElfGender $darkElfGender)
    {
        return parent::getWillModifier($darkElfGender);
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
     * @param DarkElfGender $darkElfGender
     * @return int
     */
    public function getIntelligenceModifier(DarkElfGender $darkElfGender)
    {
        return parent::getIntelligenceModifier($darkElfGender);
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
     * @param DarkElfGender $darkElfGender
     * @return int
     */
    public function getCharismaModifier(DarkElfGender $darkElfGender)
    {
        return parent::getCharismaModifier($darkElfGender);
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
     * @param DarkElfGender $darkElfGender
     * @return int
     */
    public function getResistanceModifier(DarkElfGender $darkElfGender)
    {
        return parent::getResistanceModifier($darkElfGender);
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
     * @param DarkElfGender $darkElfGender
     * @return int
     */
    public function getSensesModifier(DarkElfGender $darkElfGender)
    {
        return parent::getSensesModifier($darkElfGender);
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
        return true;
    }
}
