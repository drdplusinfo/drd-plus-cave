<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Orcs;

use DrdPlus\Cave\UnitBundle\Enum\Races\Genders\OrcGender;

/**
 * Orc
 */
abstract class Orc extends Race
{
    const BASE_STRENGTH = 0;
    const BASE_AGILITY = +2;
    const BASE_KNACK = 0;
    const BASE_WILL = -1;
    const BASE_INTELLIGENCE = 0;
    const BASE_CHARISMA = -2;
    const BASE_RESISTANCE = 0;
    const BASE_SENSES = +1;

    /**
     * Get strength modifier
     *
     * @param OrcGender $orcGender
     * @return int
     */
    public function getStrengthModifier(OrcGender $orcGender)
    {
        return parent::getStrengthModifier($orcGender);
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
     * @param OrcGender $orcGender
     * @return int
     */
    public function getAgilityModifier(OrcGender $orcGender)
    {
        return parent::getAgilityModifier($orcGender);
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
     * @param OrcGender $orcGender
     * @return int
     */
    public function getKnackModifier(OrcGender $orcGender)
    {
        return parent::getKnackModifier($orcGender);
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
     * @param OrcGender $orcGender
     * @return int
     */
    public function getWillModifier(OrcGender $orcGender)
    {
        return parent::getWillModifier($orcGender);
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
     * @param OrcGender $orcGender
     * @return int
     */
    public function getIntelligenceModifier(OrcGender $orcGender)
    {
        return parent::getIntelligenceModifier($orcGender);
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
     * @param OrcGender $orcGender
     * @return int
     */
    public function getCharismaModifier(OrcGender $orcGender)
    {
        return parent::getCharismaModifier($orcGender);
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
     * @param OrcGender $orcGender
     * @return int
     */
    public function getResistanceModifier(OrcGender $orcGender)
    {
        return parent::getResistanceModifier($orcGender);
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
     * @param OrcGender $orcGender
     * @return int
     */
    public function getSensesModifier(OrcGender $orcGender)
    {
        return parent::getSensesModifier($orcGender);
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
