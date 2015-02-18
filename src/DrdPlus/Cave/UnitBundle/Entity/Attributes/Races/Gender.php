<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races;

use Doctrineum\GEneric\Enum;

/**
 * class Gender
 */
abstract class Gender extends Enum
{

    /** overloaded parent value to get own namespace */
    const INNER_NAMESPACE = __CLASS__;

    const MALE_CODE = 'male';
    const FEMALE_CODE = 'female';

    /**
     * Call this method on specific race, not on this abstract class (it is prohibited by exception raising anyway)
     *
     * @param string $raceAndSubraceGenderCode
     * @param string $innerNamespace
     * @return Gender
     */
    public static function get($raceAndSubraceGenderCode, $innerNamespace = self::INNER_NAMESPACE)
    {
        parent::get($raceAndSubraceGenderCode, $innerNamespace);
    }

    /**
     * @param string $raceAndSubraceGenderCode
     * @throws Exceptions\UnknownGenderCode
     * @return Gender
     */
    protected static function create($raceAndSubraceGenderCode)
    {
        $gender = parent::create($raceAndSubraceGenderCode);
        /** @var $gender Gender */
        if ($gender->getRaceAndSubraceGenderCode() !== $raceAndSubraceGenderCode) {
            throw new Exceptions\UnknownGenderCode(
                'Unknown race and subrace gender code ' . var_export($raceAndSubraceGenderCode, true) . '. Has been this method called from specific gender class?'
            );
        }

        return $gender;
    }

    /**
     * @return string
     */
    protected function getRaceAndSubraceGenderCode()
    {
        return self::buildRaceAndSubraceGenderCode($this->getRaceCode(), $this->getSubraceCode(), $this->getGenderCode());
    }

    /**
     * @param string $raceCode
     * @param string $subraceCode
     * @param string $genderCode
     * @return string
     */
    public static function buildRaceAndSubraceGenderCode($raceCode, $subraceCode, $genderCode)
    {
        return "$raceCode-$subraceCode-$genderCode";
    }

    /**
     * @return string
     */
    abstract public function getRaceCode();

    /**
     * @return string
     */
    abstract public function getSubraceCode();

    /**
     * @return string
     */
    protected function getGenderCode()
    {
        if ($this->isMale()) {
            return self::MALE_CODE;
        }

        if ($this->isFemale()) {
            return self::FEMALE_CODE;
        }

        throw new Exceptions\UnknownGender('Expected male or female.');
    }

    /**
     * @return bool
     */
    abstract public function isMale();

    /**
     * @return bool
     */
    abstract public function isFemale();

    /**
     * Get strength modifier
     *
     * @return int
     */
    public function getStrengthModifier()
    {
        return 0;
    }

    /**
     * Get agility modifier
     *
     * @return int
     */
    public function getAgilityModifier()
    {
        return 0;
    }

    /**
     * Get knack modifier
     *
     * @return int
     */
    public function getKnackModifier()
    {
        return 0;
    }

    /**
     * Get will modifier
     *
     * @return int
     */
    public function getWillModifier()
    {
        return 0;
    }

    /**
     * Get intelligence modifier
     *
     * @return int
     */
    public function getIntelligenceModifier()
    {
        return 0;
    }

    /**
     * Get charisma modifier
     *
     * @return int
     */
    public function getCharismaModifier()
    {
        return 0;
    }

    /**
     * Get resistance modifier
     *
     * @return int
     */
    public function getResistanceModifier()
    {
        return 0;
    }

    /**
     * Get senses modifier
     *
     * @return int
     */
    public function getSensesModifier()
    {
        return 0;
    }

}
