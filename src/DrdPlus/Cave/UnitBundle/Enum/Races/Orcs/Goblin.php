<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Orcs;

use DrdPlus\Cave\UnitBundle\Enum\Races\Genders\GoblinGender;

/**
 * Goblin
 */
class Goblin extends Orc
{
    const CODE = 'goblin';

    const BASE_STRENGTH = -1;
    const BASE_AGILITY = +2;
    const BASE_KNACK = +1;
    const BASE_WILL = -2;
    const BASE_INTELLIGENCE = 0;
    const BASE_CHARISMA = -1;
    const BASE_RESISTANCE = 0;
    const BASE_SENSES = +1;

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
     * @param GoblinGender $goblinGender
     * @return int
     */
    public function getStrengthModifier(GoblinGender $goblinGender)
    {
        return parent::getStrengthModifier($goblinGender);
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
     * @param GoblinGender $goblinGender
     * @return int
     */
    public function getAgilityModifier(GoblinGender $goblinGender)
    {
        return parent::getAgilityModifier($goblinGender);
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
     * @param GoblinGender $goblinGender
     * @return int
     */
    public function getKnackModifier(GoblinGender $goblinGender)
    {
        return parent::getKnackModifier($goblinGender);
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
     * @param GoblinGender $goblinGender
     * @return int
     */
    public function getWillModifier(GoblinGender $goblinGender)
    {
        return parent::getWillModifier($goblinGender);
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
     * @param GoblinGender $goblinGender
     * @return int
     */
    public function getIntelligenceModifier(GoblinGender $goblinGender)
    {
        return parent::getIntelligenceModifier($goblinGender);
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
     * @param GoblinGender $goblinGender
     * @return int
     */
    public function getCharismaModifier(GoblinGender $goblinGender)
    {
        return parent::getCharismaModifier($goblinGender);
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
     * @param GoblinGender $goblinGender
     * @return int
     */
    public function getResistanceModifier(GoblinGender $goblinGender)
    {
        return parent::getResistanceModifier($goblinGender);
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
     * @param GoblinGender $goblinGender
     * @return int
     */
    public function getSensesModifier(GoblinGender $goblinGender)
    {
        return parent::getSensesModifier($goblinGender);
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
