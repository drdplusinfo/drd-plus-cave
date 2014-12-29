<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Orcs;

use DrdPlus\Cave\UnitBundle\Enum\Races\Orcs\Genders\SkurutGender;

/**
 * Skurut
 */
class Skurut extends Orc
{
    const CODE = 'skurut';

    const BASE_STRENGTH = +1;
    const BASE_AGILITY = +1;
    const BASE_KNACK = -1;
    const BASE_WILL = 0;
    const BASE_INTELLIGENCE = 0;
    const BASE_CHARISMA = -2;
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
     * @param SkurutGender $skurutGender
     * @return int
     */
    public function getStrengthModifier(SkurutGender $skurutGender)
    {
        return parent::getStrengthModifier($skurutGender);
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
     * @param SkurutGender $skurutGender
     * @return int
     */
    public function getAgilityModifier(SkurutGender $skurutGender)
    {
        return parent::getAgilityModifier($skurutGender);
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
     * @param SkurutGender $skurutGender
     * @return int
     */
    public function getKnackModifier(SkurutGender $skurutGender)
    {
        return parent::getKnackModifier($skurutGender);
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
     * @param SkurutGender $skurutGender
     * @return int
     */
    public function getWillModifier(SkurutGender $skurutGender)
    {
        return parent::getWillModifier($skurutGender);
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
     * @param SkurutGender $skurutGender
     * @return int
     */
    public function getIntelligenceModifier(SkurutGender $skurutGender)
    {
        return parent::getIntelligenceModifier($skurutGender);
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
     * @param SkurutGender $skurutGender
     * @return int
     */
    public function getCharismaModifier(SkurutGender $skurutGender)
    {
        return parent::getCharismaModifier($skurutGender);
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
     * @param SkurutGender $skurutGender
     * @return int
     */
    public function getResistanceModifier(SkurutGender $skurutGender)
    {
        return parent::getResistanceModifier($skurutGender);
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
     * @param SkurutGender $skurutGender
     * @return int
     */
    public function getSensesModifier(SkurutGender $skurutGender)
    {
        return parent::getSensesModifier($skurutGender);
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
