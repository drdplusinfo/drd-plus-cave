<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Humans;

use DrdPlus\Cave\UnitBundle\Enum\Races\Humans\Genders\HighlanderGender;

/**
 * Highlander
 */
class Highlander extends Human
{
    const CODE = 'highlander';

    const BASE_STRENGTH = +1;
    const BASE_WILL = +1;
    const BASE_INTELLIGENCE = -1;
    const BASE_CHARISMA = -1;

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
     * @param HighlanderGender $highlanderGender
     * @return int
     */
    public function getStrengthModifier(HighlanderGender $highlanderGender)
    {
        return parent::getStrengthModifier($highlanderGender);
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
     * @param HighlanderGender $highlanderGender
     * @return int
     */
    public function getAgilityModifier(HighlanderGender $highlanderGender)
    {
        return parent::getAgilityModifier($highlanderGender);
    }

    /**
     * Get knack modifier
     *
     * @param HighlanderGender $highlanderGender
     * @return int
     */
    public function getKnackModifier(HighlanderGender $highlanderGender)
    {
        return parent::getKnackModifier($highlanderGender);
    }

    /**
     * Get will modifier
     *
     * @param HighlanderGender $highlanderGender
     * @return int
     */
    public function getWillModifier(HighlanderGender $highlanderGender)
    {
        return parent::getWillModifier($highlanderGender);
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
     * @param HighlanderGender $highlanderGender
     * @return int
     */
    public function getIntelligenceModifier(HighlanderGender $highlanderGender)
    {
        return parent::getIntelligenceModifier($highlanderGender);
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
     * @param HighlanderGender $highlanderGender
     * @return int
     */
    public function getCharismaModifier(HighlanderGender $highlanderGender)
    {
        return parent::getCharismaModifier($highlanderGender);
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
     * @param HighlanderGender $highlanderGender
     * @return int
     */
    public function getResistanceModifier(HighlanderGender $highlanderGender)
    {
        return parent::getResistanceModifier($highlanderGender);
    }

    /**
     * Get senses modifier
     *
     * @param HighlanderGender $highlanderGender
     * @return int
     */
    public function getSensesModifier(HighlanderGender $highlanderGender)
    {
        return parent::getSensesModifier($highlanderGender);
    }
}
