<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races;

use DrdPlus\Cave\UnitBundle\Enum\Races\Genders\HobbitGender;

/**
 * Hobbit
 */
class Hobbit extends Race
{
    const CODE = 'hobbit';

    const BASE_STRENGTH = -3;
    const BASE_AGILITY = +1;
    const BASE_KNACK = +1;
    const BASE_WILL = 0;
    const BASE_INTELLIGENCE = -1;
    const BASE_CHARISMA = +2;
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
     * @param HobbitGender $hobbitGender
     * @return int
     */
    public function getStrengthModifier(HobbitGender $hobbitGender)
    {
        return parent::getStrengthModifier($hobbitGender);
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
     * @param HobbitGender $hobbitGender
     * @return int
     */
    public function getAgilityModifier(HobbitGender $hobbitGender)
    {
        return parent::getAgilityModifier($hobbitGender);
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
     * @param HobbitGender $hobbitGender
     * @return int
     */
    public function getKnackModifier(HobbitGender $hobbitGender)
    {
        return parent::getKnackModifier($hobbitGender);
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
     * @param HobbitGender $hobbitGender
     * @return int
     */
    public function getWillModifier(HobbitGender $hobbitGender)
    {
        return parent::getWillModifier($hobbitGender);
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
     * @param HobbitGender $hobbitGender
     * @return int
     */
    public function getIntelligenceModifier(HobbitGender $hobbitGender)
    {
        return parent::getIntelligenceModifier($hobbitGender);
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
     * @param HobbitGender $hobbitGender
     * @return int
     */
    public function getCharismaModifier(HobbitGender $hobbitGender)
    {
        return parent::getCharismaModifier($hobbitGender);
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
     * @param HobbitGender $hobbitGender
     * @return int
     */
    public function getResistanceModifier(HobbitGender $hobbitGender)
    {
        return parent::getResistanceModifier($hobbitGender);
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
     * @param HobbitGender $hobbitGender
     * @return int
     */
    public function getSensesModifier(HobbitGender $hobbitGender)
    {
        return parent::getSensesModifier($hobbitGender);
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
