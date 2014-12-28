<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Krolls;

use DrdPlus\Cave\UnitBundle\Enum\Races\Genders\WildKrollGender;

/**
 * WildKroll
 */
class WildKroll extends Kroll
{
    const CODE = 'wild-kroll';

    const BASE_STRENGTH = +3;
    const BASE_AGILITY = -1;
    const BASE_KNACK = -2;
    const BASE_WILL = +2;
    const BASE_INTELLIGENCE = -3;
    const BASE_CHARISMA = -2;
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
     * @param WildKrollGender $wildKrollGender
     * @return int
     */
    public function getStrengthModifier(WildKrollGender $wildKrollGender)
    {
        return parent::getStrengthModifier($wildKrollGender);
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
     * @param WildKrollGender $wildKrollGender
     * @return int
     */
    public function getAgilityModifier(WildKrollGender $wildKrollGender)
    {
        return parent::getAgilityModifier($wildKrollGender);
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
     * @param WildKrollGender $wildKrollGender
     * @return int
     */
    public function getKnackModifier(WildKrollGender $wildKrollGender)
    {
        return parent::getKnackModifier($wildKrollGender);
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
     * @param WildKrollGender $wildKrollGender
     * @return int
     */
    public function getWillModifier(WildKrollGender $wildKrollGender)
    {
        return parent::getWillModifier($wildKrollGender);
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
     * @param WildKrollGender $wildKrollGender
     * @return int
     */
    public function getIntelligenceModifier(WildKrollGender $wildKrollGender)
    {
        return parent::getIntelligenceModifier($wildKrollGender);
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
     * @param WildKrollGender $wildKrollGender
     * @return int
     */
    public function getCharismaModifier(WildKrollGender $wildKrollGender)
    {
        return parent::getCharismaModifier($wildKrollGender);
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
     * @param WildKrollGender $wildKrollGender
     * @return int
     */
    public function getResistanceModifier(WildKrollGender $wildKrollGender)
    {
        return parent::getResistanceModifier($wildKrollGender);
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
     * @param WildKrollGender $wildKrollGender
     * @return int
     */
    public function getSensesModifier(WildKrollGender $wildKrollGender)
    {
        return parent::getSensesModifier($wildKrollGender);
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
        return true;
    }

    /**
     * @return bool
     */
    public function requiresDungeonMasterAgreement()
    {
        return true;
    }
}
