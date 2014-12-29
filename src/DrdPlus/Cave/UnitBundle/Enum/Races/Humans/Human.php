<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Humans;

use DrdPlus\Cave\UnitBundle\Enum\Races\Humans\Genders\HumanGender;
use DrdPlus\Cave\UnitBundle\Enum\Races\Race;

/**
 * Human
 */
abstract class Human extends Race
{
    const BASE_STRENGTH = 0;
    const BASE_AGILITY = 0;
    const BASE_KNACK = 0;
    const BASE_WILL = 0;
    const BASE_INTELLIGENCE = 0;
    const BASE_CHARISMA = 0;
    const BASE_RESISTANCE = 0;
    const BASE_SENSES = 0;

    /**
     * Get strength modifier
     *
     * @param HumanGender $humanGender
     * @return int
     */
    public function getStrengthModifier(HumanGender $humanGender)
    {
        return parent::getStrengthModifier($humanGender);
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
     * @param HumanGender $humanGender
     * @return int
     */
    public function getAgilityModifier(HumanGender $humanGender)
    {
        return parent::getAgilityModifier($humanGender);
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
     * @param HumanGender $humanGender
     * @return int
     */
    public function getKnackModifier(HumanGender $humanGender)
    {
        return parent::getKnackModifier($humanGender);
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
     * @param HumanGender $humanGender
     * @return int
     */
    public function getWillModifier(HumanGender $humanGender)
    {
        return parent::getWillModifier($humanGender);
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
     * @param HumanGender $humanGender
     * @return int
     */
    public function getIntelligenceModifier(HumanGender $humanGender)
    {
        return parent::getIntelligenceModifier($humanGender);
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
     * @param HumanGender $humanGender
     * @return int
     */
    public function getCharismaModifier(HumanGender $humanGender)
    {
        return parent::getCharismaModifier($humanGender);
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
     * @param HumanGender $humanGender
     * @return int
     */
    public function getResistanceModifier(HumanGender $humanGender)
    {
        return parent::getResistanceModifier($humanGender);
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
     * @param HumanGender $humanGender
     * @return int
     */
    public function getSensesModifier(HumanGender $humanGender)
    {
        return parent::getSensesModifier($humanGender);
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
