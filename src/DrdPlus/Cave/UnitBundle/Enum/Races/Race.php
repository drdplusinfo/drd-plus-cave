<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races;

use DrdPlus\Cave\UnitBundle\Enum\Enum;
use DrdPlus\Cave\UnitBundle\Enum\Races\Genders\Female;
use DrdPlus\Cave\UnitBundle\Enum\Races\Genders\Gender;
use DrdPlus\Cave\UnitBundle\Enum\Races\Genders\Male;

/**
 * Race
 */
abstract class Race extends Enum
{
    /** @var string $genderCode */
    private $genderCode;

    /**
     * @param string $genderCode
     */
    public function __construct($genderCode)
    {
        $this->genderCode = $genderCode;
        $this->gender = $this->createGender($genderCode);
    }

    /**
     * @param string $genderCode
     * @return Gender
     * @throws \RuntimeException
     */
    protected function createGender($genderCode)
    {
        switch($genderCode) {
            case Male::CODE :
                return new Male();
            case Female::CODE :
                return new Female();
            default :
                throw new \RuntimeException('Unknown gender code ' . var_export($genderCode, true));
        }
    }

    /**
     * Get gender code
     *
     * @return string
     */
    public function getGenderCode()
    {
        return $this->genderCode;
    }

    /**
     * Get gender
     *
     * @return Gender
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Code for identification of a race
     *
     * @return string
     */
    abstract public function getCode();

    /**
     * Get strength modifier
     *
     * @return integer
     */
    abstract public function getStrengthModifier();

    /**
     * Get agility modifier
     *
     * @return integer
     */
    abstract public function getAgilityModifier();

    /**
     * Get knack modifier
     *
     * @return integer
     */
    abstract public function getKnackModifier();

    /**
     * Get will modifier
     *
     * @return integer
     */
    abstract public function getWillModifier();

    /**
     * Get intelligence modifier
     *
     * @return integer
     */
    abstract public function getIntelligenceModifier();

    /**
     * Get charisma modifier
     *
     * @return integer
     */
    abstract public function getCharismaModifier();

    /**
     * Get stamina modifier
     *
     * @return integer
     */
    abstract public function getResistanceModifier();

    /**
     * Get senses modifier
     *
     * @return integer
     */
    abstract public function getSensesModifier();

    /**
     * @return bool
     */
    abstract public function hasInfravision();

    /**
     * @return bool
     */
    abstract public function hasNaturalRegeneration();

    /**
     * (Races with "star")
     *
     * @return true
     */
    abstract public function requiresDungeonMasterAgreement();
}
