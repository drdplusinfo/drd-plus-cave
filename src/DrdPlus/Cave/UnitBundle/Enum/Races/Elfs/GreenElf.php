<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Elfs;

use DrdPlus\Cave\UnitBundle\Enum\Races\Elfs\Genders\GreenElfGender;

/**
 * GreenElf
 */
class GreenElf extends Elf
{
    const CODE = 'green-elf';

    const BASE_STRENGTH = -1;
    const BASE_AGILITY = 1;
    const BASE_KNACK = 0;
    const BASE_WILL = -1;
    const BASE_INTELLIGENCE = 1;
    const BASE_CHARISMA = 1;
    const BASE_RESISTANCE = -1;
    const BASE_SENSES = 0;

    /**
     * @return string
     */
    protected function getSubRaceCode()
    {
        return self::CODE;
    }

    /**
     * Get strength modifier
     *
     * @param GreenElfGender $greenElfGender
     * @return int
     */
    public function getStrengthModifier(GreenElfGender $greenElfGender)
    {
        return parent::getStrengthModifier($greenElfGender);
    }

    /**
     * @return int
     */
    protected function getBaseStrength()
    {
        return self::BASE_STRENGTH;
    }

    /**
     * Get agility modifier
     *
     * @param GreenElfGender $greenElfGender
     * @return int
     */
    public function getAgilityModifier(GreenElfGender $greenElfGender)
    {
        return parent::getAgilityModifier($greenElfGender);
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
     * @param GreenElfGender $greenElfGender
     * @return int
     */
    public function getKnackModifier(GreenElfGender $greenElfGender)
    {
        return parent::getKnackModifier($greenElfGender);
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
     * @param GreenElfGender $greenElfGender
     * @return int
     */
    public function getWillModifier(GreenElfGender $greenElfGender)
    {
        return parent::getWillModifier($greenElfGender);
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
     * @param GreenElfGender $greenElfGender
     * @return int
     */
    public function getIntelligenceModifier(GreenElfGender $greenElfGender)
    {
        return parent::getIntelligenceModifier($greenElfGender);
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
     * @param GreenElfGender $greenElfGender
     * @return int
     */
    public function getCharismaModifier(GreenElfGender $greenElfGender)
    {
        return parent::getCharismaModifier($greenElfGender);
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
     * @param GreenElfGender $greenElfGender
     * @return int
     */
    public function getResistanceModifier(GreenElfGender $greenElfGender)
    {
        return parent::getResistanceModifier($greenElfGender);
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
     * @param GreenElfGender $greenElfGender
     * @return int
     */
    public function getSensesModifier(GreenElfGender $greenElfGender)
    {
        return parent::getSensesModifier($greenElfGender);
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
        return false;
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
