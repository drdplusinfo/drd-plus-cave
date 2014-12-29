<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Krolls;

use DrdPlus\Cave\UnitBundle\Enum\Races\Krolls\Genders\KrollGender;
use DrdPlus\Cave\UnitBundle\Enum\Races\Race;

/**
 * Kroll
 */
abstract class Kroll extends Race
{
    const BASE_STRENGTH = +3;
    const BASE_AGILITY = -2;
    const BASE_KNACK = -1;
    const BASE_WILL = +1;
    const BASE_INTELLIGENCE = -3;
    const BASE_CHARISMA = -1;
    const BASE_RESISTANCE = 0;
    const BASE_SENSES = 0;

    /**
     * Get strength modifier
     *
     * @param KrollGender $krollGender
     * @return int
     */
    public function getStrengthModifier(KrollGender $krollGender)
    {
        return parent::getStrengthModifier($krollGender);
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
     * @param KrollGender $krollGender
     * @return int
     */
    public function getAgilityModifier(KrollGender $krollGender)
    {
        return parent::getAgilityModifier($krollGender);
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
     * @param KrollGender $krollGender
     * @return int
     */
    public function getKnackModifier(KrollGender $krollGender)
    {
        return parent::getKnackModifier($krollGender);
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
     * @param KrollGender $krollGender
     * @return int
     */
    public function getWillModifier(KrollGender $krollGender)
    {
        return parent::getWillModifier($krollGender);
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
     * @param KrollGender $krollGender
     * @return int
     */
    public function getIntelligenceModifier(KrollGender $krollGender)
    {
        return parent::getIntelligenceModifier($krollGender);
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
     * @param KrollGender $krollGender
     * @return int
     */
    public function getCharismaModifier(KrollGender $krollGender)
    {
        return parent::getCharismaModifier($krollGender);
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
     * @param KrollGender $krollGender
     * @return int
     */
    public function getResistanceModifier(KrollGender $krollGender)
    {
        return parent::getResistanceModifier($krollGender);
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
     * @param KrollGender $krollGender
     * @return int
     */
    public function getSensesModifier(KrollGender $krollGender)
    {
        return parent::getSensesModifier($krollGender);
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
        return false;
    }
}
