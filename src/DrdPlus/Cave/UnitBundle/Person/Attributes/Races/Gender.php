<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrineum\Strict\String\SelfTypedStrictStringEnum;

/**
 * @method static Gender getType(string $name),
 * @see SelfTypedStrictStringEnum::getType or for original
 * @see \Doctrine\DBAL\Types\Type::getType
 *
 * @method Gender convertToPHPValue(string $value, AbstractPlatform $platform)
 * @see SelfTypedStrictStringEnum::convertToPHPValue or for original
 * @see EnumType::convertToPHPValue
 *
 * @method static Gender getEnum(mixed $value)
 * @see SelfTypedStrictStringEnum::getEnum or for original
 * @see EnumTrait::getEnum
 */
/* abstract */

class Gender extends SelfTypedStrictStringEnum
{
    const GENDER = 'gender';

    const MALE_CODE = 'male';
    const FEMALE_CODE = 'female';

    const STRENGTH_MODIFIER = 0;
    const AGILITY_MODIFIER = 0;
    const KNACK_MODIFIER = 0;
    const WILL_MODIFIER = 0;
    const INTELLIGENCE_MODIFIER = 0;
    const CHARISMA_MODIFIER = 0;

    const RESISTANCE_MODIFIER = 0;
    const SENSES_MODIFIER = 0;
    const MALE_SIZE_MODIFIER = 0;
    const MALE_WEIGHT_MODIFIER = 0;

    /**
     * @return Gender
     */
    public static function getIt()
    {
        return static::getEnum(static::getRaceSubraceAndGenderCode());
    }

    /**
     * Gets the strongly recommended name of this type.
     * Its used at @see \Doctrine\DBAL\Platforms\AbstractPlatform::getDoctrineTypeComment
     *
     * @return string
     */
    public static function getTypeName()
    {
        if (static::class === __CLASS__) {
            return parent::getTypeName();
        }

        return static::getRaceSubraceAndGenderCode();
    }

    /**
     * @param string $enumValue
     *
     * @return string
     */
    protected static function getEnumClass($enumValue)
    {
        $specificRaceGenderClass = parent::getEnumClass($enumValue);
        if ($specificRaceGenderClass === __CLASS__) {
            throw new Exceptions\GenericRaceCanNotBeCreated('Call this factory method from specific race gender.');
        }

        return $specificRaceGenderClass;
    }

    /**
     * All genders can be annotated just as "gender" type.
     * The specific gender will be build here, distinguished by the race, subrace and gender code.
     *
     * @param string $raceAndSubraceGenderCode
     *
     * @throws Exceptions\UnexpectedGenderCode
     * @return Gender
     */
    protected static function createByValue($raceAndSubraceGenderCode)
    {
        $gender = parent::createByValue($raceAndSubraceGenderCode);
        /** @var $gender Gender */
        if ($gender::getRaceSubraceAndGenderCode() !== $raceAndSubraceGenderCode) {
            throw new Exceptions\UnexpectedGenderCode(
                'Unknown race, subrace and gender code ' . var_export($raceAndSubraceGenderCode, true) . '. ' .
                'Got gender with race, subrace and gender code ' . var_export($gender::getRaceSubraceAndGenderCode(), true) . '. ' .
                'Has been this method called from specific gender class?'
            );
        }

        return $gender;
    }

    /**
     * @return string
     */
    protected static function getRaceSubraceAndGenderCode()
    {
        return self::buildRaceAndSubraceGenderCode(static::getRaceCode(), static::getSubraceCode(), static::getGenderCode());
    }

    /**
     * @return string
     */
    /* abstract */
    public static function getRaceCode()
    {
        throw new Exceptions\MissingRaceCodeImplementation(
            'The gender class ' . static::class . ' has not implemented ' . __METHOD__ . ' method.'
        );
    }

    /**
     * @return string
     */
    /* abstract */
    public static function getSubraceCode()
    {
        throw new Exceptions\MissingSubraceCodeImplementation(
            'The gender class ' . static::class . ' has not implemented ' . __METHOD__ . ' method.'
        );
    }

    /**
     * @return string
     */
    protected static function getGenderCode()
    {
        if (static::isMale() && static::isFemale()) {
            throw new Exceptions\AmbiguousGender(
                'Gender ' . static::class . ' can not be male and female at once'
            );
        }

        if (static::isMale()) {
            return self::MALE_CODE;
        }

        if (static::isFemale()) {
            return self::FEMALE_CODE;
        }

        throw new Exceptions\UnknownGender('Expected male or female of gender class ' . static::class);
    }

    /**
     * @param string $raceCode
     * @param string $subraceCode
     * @param string $genderCode
     *
     * @return string
     */
    public static function buildRaceAndSubraceGenderCode($raceCode, $subraceCode, $genderCode)
    {
        return "$raceCode-$subraceCode-$genderCode";
    }

    public static function registerSelfSubRaceGender()
    {
        return static::addSubTypeEnum(
            static::class,
            '~^' . static::getRaceSubraceAndGenderCode() . '$~'
        );
    }

    /**
     * @return bool
     */
    /* abstract */
    public static function isMale()
    {
        throw new Exceptions\MaleDetectionNotImplemented();
    }

    /**
     * @return bool
     */
    /* abstract */
    public static function isFemale()
    {
        throw new Exceptions\FemaleDetectionNotImplemented();
    }

    /**
     * Get strength modifier
     *
     * @return int
     */
    public function getStrengthModifier()
    {
        return static::STRENGTH_MODIFIER;
    }

    /**
     * Get agility modifier
     *
     * @return int
     */
    public function getAgilityModifier()
    {
        return static::AGILITY_MODIFIER;
    }

    /**
     * Get knack modifier
     *
     * @return int
     */
    public function getKnackModifier()
    {
        return static::KNACK_MODIFIER;
    }

    /**
     * Get will modifier
     *
     * @return int
     */
    public function getWillModifier()
    {
        return static::WILL_MODIFIER;
    }

    /**
     * Get intelligence modifier
     *
     * @return int
     */
    public function getIntelligenceModifier()
    {
        return static::INTELLIGENCE_MODIFIER;
    }

    /**
     * Get charisma modifier
     *
     * @return int
     */
    public function getCharismaModifier()
    {
        return static::CHARISMA_MODIFIER;
    }

    /**
     * Get resistance modifier
     *
     * @return int
     */
    public function getResistanceModifier()
    {
        return static::RESISTANCE_MODIFIER;
    }

    /**
     * Get senses modifier
     *
     * @return int
     */
    public function getSensesModifier()
    {
        return static::SENSES_MODIFIER;
    }

    /**
     * @return int
     */
    public function getSizeModifier()
    {
        /** @see PPH page 33, left column */
        if ($this->isFemale()) {
            return $this->getStrengthModifier();
        }

        return static::MALE_SIZE_MODIFIER;
    }

    /**
     * @return int
     */
    public function getWeightModifier()
    {
        /** @see PPH page 33, left column */
        if ($this->isFemale()) {
            return $this->getStrengthModifier();
        }

        return static::MALE_WEIGHT_MODIFIER;
    }

}
