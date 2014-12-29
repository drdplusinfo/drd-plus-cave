<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Dwarfs;

use DrdPlus\Cave\UnitBundle\Enum\Races\Dwarfs\Genders\WoodDwarfGender;

/**
 * WoodDwarf
 */
class WoodDwarf extends Dwarf
{
    const CODE = 'wood-dwarf';

    const BASE_STRENGTH = +1;
    const BASE_AGILITY = -1;
    const BASE_KNACK = 0;
    const BASE_WILL = +1;
    const BASE_INTELLIGENCE = -1;
    const BASE_CHARISMA = -1;
    const BASE_RESISTANCE = +1;
    const BASE_SENSES = -1;

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
     * @param WoodDwarfGender $woodDwarfGender
     * @return int
     */
    public function getStrengthModifier(WoodDwarfGender $woodDwarfGender)
    {
        return parent::getStrengthModifier($woodDwarfGender);
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
     * @param WoodDwarfGender $woodDwarfGender
     * @return int
     */
    public function getAgilityModifier(WoodDwarfGender $woodDwarfGender)
    {
        return parent::getAgilityModifier($woodDwarfGender);
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
     * @param WoodDwarfGender $woodDwarfGender
     * @return int
     */
    public function getKnackModifier(WoodDwarfGender $woodDwarfGender)
    {
        return parent::getKnackModifier($woodDwarfGender);
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
     * @param WoodDwarfGender $woodDwarfGender
     * @return int
     */
    public function getWillModifier(WoodDwarfGender $woodDwarfGender)
    {
        return parent::getWillModifier($woodDwarfGender);
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
     * @param WoodDwarfGender $woodDwarfGender
     * @return int
     */
    public function getIntelligenceModifier(WoodDwarfGender $woodDwarfGender)
    {
        return parent::getIntelligenceModifier($woodDwarfGender);
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
     * @param WoodDwarfGender $woodDwarfGender
     * @return int
     */
    public function getCharismaModifier(WoodDwarfGender $woodDwarfGender)
    {
        return parent::getCharismaModifier($woodDwarfGender);
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
     * @param WoodDwarfGender $woodDwarfGender
     * @return int
     */
    public function getResistanceModifier(WoodDwarfGender $woodDwarfGender)
    {
        return parent::getResistanceModifier($woodDwarfGender);
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
     * @param WoodDwarfGender $woodDwarfGender
     * @return int
     */
    public function getSensesModifier(WoodDwarfGender $woodDwarfGender)
    {
        return parent::getSensesModifier($woodDwarfGender);
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
        return false;
    }
}
