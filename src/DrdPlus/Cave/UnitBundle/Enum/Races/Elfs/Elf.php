<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Elfs;

use DrdPlus\Cave\UnitBundle\Enum\Races\Elfs\Genders\ElfGender;
use DrdPlus\Cave\UnitBundle\Enum\Races\Race;

/**
 * Elf
 */
abstract class Elf extends Race
{
    const BASE_STRENGTH = -1;
    const BASE_AGILITY = +1;
    const BASE_KNACK = +1;
    const BASE_WILL = -2;
    const BASE_INTELLIGENCE = +1;
    const BASE_CHARISMA = +1;
    const BASE_RESISTANCE = -1;
    const BASE_SENSES = 0;

    /**
     * @return string
     */
    protected function getRaceCode()
    {
        return $this->getSubRaceCode();
    }

    /**
     * @return string
     */
    abstract protected function getSubRaceCode();

    /**
     * Get strength modifier
     *
     * @param ElfGender $elfGender
     * @return int
     */
    public function getStrengthModifier(ElfGender $elfGender)
    {
        return parent::getStrengthModifier($elfGender);
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
     * @param ElfGender $elfGender
     * @return int
     */
    public function getAgilityModifier(ElfGender $elfGender)
    {
        return parent::getAgilityModifier($elfGender);
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
     * @param ElfGender $elfGender
     * @return int
     */
    public function getKnackModifier(ElfGender $elfGender)
    {
        return parent::getKnackModifier($elfGender);
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
     * @param ElfGender $elfGender
     * @return int
     */
    public function getWillModifier(ElfGender $elfGender)
    {
        return parent::getWillModifier($elfGender);
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
     * @param ElfGender $elfGender
     * @return int
     */
    public function getIntelligenceModifier(ElfGender $elfGender)
    {
        return parent::getIntelligenceModifier($elfGender);
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
     * @param ElfGender $elfGender
     * @return int
     */
    public function getCharismaModifier(ElfGender $elfGender)
    {
        return parent::getCharismaModifier($elfGender);
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
     * @param ElfGender $elfGender
     * @return int
     */
    public function getResistanceModifier(ElfGender $elfGender)
    {
        return parent::getResistanceModifier($elfGender);
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
     * @param ElfGender $elfGender
     * @return int
     */
    public function getSensesModifier(ElfGender $elfGender)
    {
        return parent::getSensesModifier($elfGender);
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
