<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races;

use DrdPlus\Cave\UnitBundle\Enum\Races\Genders\MountainDwarfGender;

/**
 * MountainDwarf
 */
class MountainDwarf extends Race
{
    const CODE = 'mountain-dwarf';

    const BASE_STRENGTH = +2;
    const BASE_AGILITY = -1;
    const BASE_KNACK = 0;
    const BASE_WILL = +2;
    const BASE_INTELLIGENCE = -2;
    const BASE_CHARISMA = -2;
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
     * @param MountainDwarfGender $mountainDwarfGender
     * @return int
     */
    public function getStrengthModifier(MountainDwarfGender $mountainDwarfGender)
    {
        return parent::getStrengthModifier($mountainDwarfGender);
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
     * @param MountainDwarfGender $mountainDwarfGender
     * @return int
     */
    public function getAgilityModifier(MountainDwarfGender $mountainDwarfGender)
    {
        return parent::getAgilityModifier($mountainDwarfGender);
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
     * @param MountainDwarfGender $mountainDwarfGender
     * @return int
     */
    public function getKnackModifier(MountainDwarfGender $mountainDwarfGender)
    {
        return parent::getKnackModifier($mountainDwarfGender);
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
     * @param MountainDwarfGender $mountainDwarfGender
     * @return int
     */
    public function getWillModifier(MountainDwarfGender $mountainDwarfGender)
    {
        return parent::getWillModifier($mountainDwarfGender);
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
     * @param MountainDwarfGender $mountainDwarfGender
     * @return int
     */
    public function getIntelligenceModifier(MountainDwarfGender $mountainDwarfGender)
    {
        return parent::getIntelligenceModifier($mountainDwarfGender);
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
     * @param MountainDwarfGender $mountainDwarfGender
     * @return int
     */
    public function getCharismaModifier(MountainDwarfGender $mountainDwarfGender)
    {
        return parent::getCharismaModifier($mountainDwarfGender);
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
     * @param MountainDwarfGender $mountainDwarfGender
     * @return int
     */
    public function getResistanceModifier(MountainDwarfGender $mountainDwarfGender)
    {
        return parent::getResistanceModifier($mountainDwarfGender);
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
     * @param MountainDwarfGender $mountainDwarfGender
     * @return int
     */
    public function getSensesModifier(MountainDwarfGender $mountainDwarfGender)
    {
        return parent::getSensesModifier($mountainDwarfGender);
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
