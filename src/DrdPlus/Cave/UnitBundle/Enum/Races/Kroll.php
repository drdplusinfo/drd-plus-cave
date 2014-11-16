<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races;

use DrdPlus\Cave\UnitBundle\Enum\Races\Genders\Female;
use DrdPlus\Cave\UnitBundle\Enum\Races\Genders\Gender;
use DrdPlus\Cave\UnitBundle\Enum\Races\Genders\KrollFemale;

/**
 * Kroll
 */
class Kroll extends Race
{
    const CODE = 'kroll';
    const LABEL = 'Kroll';
    const STRENGTH_MODIFIER = +3;
    const AGILITY_MODIFIER = -2;
    const KNACK_MODIFIER = -1;
    const WILL_MODIFIER = +1;
    const INTELLIGENCE_MODIFIER = -3;
    const CHARISMA_MODIFIER = -1;
    const RESISTANCE_MODIFIER = 0;
    const SENSES_MODIFIER = 0;

    /**
     * @param string $genderCode
     * @return Gender
     * @throws \RuntimeException
     */
    protected function createGender($genderCode)
    {
        switch ($genderCode) {
            case Female::CODE :
                return new KrollFemale();
            default :
                return parent::createGender($genderCode);
        }
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return self::CODE;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return self::LABEL;
    }

    /**
     * Get strength modifier
     *
     * @return integer
     */
    public function getStrengthModifier()
    {
        return self::STRENGTH_MODIFIER;
    }

    /**
     * Get agility modifier
     *
     * @return integer
     */
    public function getAgilityModifier()
    {
        return self::AGILITY_MODIFIER;
    }

    /**
     * Get knack modifier
     *
     * @return integer
     */
    public function getKnackModifier()
    {
        return self::KNACK_MODIFIER;
    }

    /**
     * Get will modifier
     *
     * @return integer
     */
    public function getWillModifier()
    {
        return self::WILL_MODIFIER;
    }

    /**
     * Get intelligence modifier
     *
     * @return integer
     */
    public function getIntelligenceModifier()
    {
        return self::INTELLIGENCE_MODIFIER;
    }

    /**
     * Get charisma modifier
     *
     * @return integer
     */
    public function getCharismaModifier()
    {
        return self::CHARISMA_MODIFIER;
    }

    /**
     * Get resistance modifier
     *
     * @return integer
     */
    public function getResistanceModifier()
    {
        return self::RESISTANCE_MODIFIER;
    }

    /**
     * Get senses modifier
     *
     * @return integer
     */
    public function getSensesModifier()
    {
        return self::SENSES_MODIFIER;
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
