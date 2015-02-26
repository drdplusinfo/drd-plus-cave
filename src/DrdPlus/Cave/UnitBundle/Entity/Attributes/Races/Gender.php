<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races;

use Doctrineum\Strict\String\SelfTypedStrictStringEnum;

/**
 * class Gender
 */
abstract class Gender extends SelfTypedStrictStringEnum
{

    const MALE_CODE = 'male';
    const FEMALE_CODE = 'female';

    /**
     * Call this method on specific race, not on this abstract class
     * (it is prohibited by exception raising anyway),
     * @see Gender::createByValue
     *
     * @param string $raceAndSubraceGenderCode
     * @param string $innerNamespace
     * @return Gender
     */
    public static function getEnum($raceAndSubraceGenderCode, $innerNamespace = __CLASS__)
    {
        parent::getEnum($raceAndSubraceGenderCode, $innerNamespace);
    }

    /**
     * Gets the strongly recommended name of this type.
     * Its used at @see \Doctrine\DBAL\Platforms\AbstractPlatform::getDoctrineTypeComment
     *
     * @return string
     */
    public static function getTypeName()
    {
        return static::getRaceAndSubraceGenderCode();
    }

    /**
     * @param string $raceAndSubraceGenderCode
     * @throws Exceptions\UnknownGenderCode
     * @return Gender
     */
    protected static function createByValue($raceAndSubraceGenderCode)
    {
        $gender = parent::createByValue($raceAndSubraceGenderCode);
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
        return self::buildRaceAndSubraceGenderCode(static::getRaceCode(), static::getSubraceCode(), static::getGenderCode());
    }

    /**
     * @return string
     */
    public static function getRaceCode() {
        throw new Exceptions\MissingRaceCodeImplementation();
    }

    /**
     * @return string
     */
    public static function getSubraceCode() {
        throw new Exceptions\MissingSubraceCodeImplementation();
    }

    /**
     * @return string
     */
    protected static function getGenderCode()
    {
        if (static::isMale()) {
            return self::MALE_CODE;
        }

        if (static::isFemale()) {
            return self::FEMALE_CODE;
        }

        throw new Exceptions\UnknownGender('Expected male or female.');
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
     * @return bool
     */
    public static function isMale() {
        throw new Exceptions\IsMaleDetectionNotImplemented();
    }

    /**
     * @return bool
     */
    public static function isFemale() {
        throw new Exceptions\IsFemaleDetectionNotImplemented();
    }

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
