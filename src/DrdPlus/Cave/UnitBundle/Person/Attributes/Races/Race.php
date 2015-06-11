<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races;

use Doctrineum\Strict\String\SelfTypedStrictStringEnum;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\RemarkableSenses\SenseInterface;

/**
 * Race
 *
 * The race itself can not be abstract due to its factory functionality
 */
class Race extends SelfTypedStrictStringEnum
{
    const RACE = 'race';
    const RACE_CODE = 'race';
    const SUBRACE_CODE = 'race';

    const BASE_STRENGTH = +0;
    const BASE_AGILITY = +0;
    const BASE_KNACK = +0;
    const BASE_WILL = +0;
    const BASE_INTELLIGENCE = +0;
    const BASE_CHARISMA = +0;
    const BASE_RESISTANCE = +0;
    const BASE_SENSES = +0;
    const BASE_TOUGHNESS = +0;
    const BASE_HEIGHT = +5; // TODO is it needed? 180 cm, see table of distance -> to bonus
    const BASE_HEIGHT_IN_CM = 180.0;
    const BASE_SIZE = +0;
    const BASE_WEIGHT = +6; // 80 kg, see table of weight -> to bonus
    const BASE_WEIGHT_IN_KG = 80.0;

    /**
     * @return Race
     */
    public static function getIt()
    {
        return static::getEnum(static::getRaceAndSubraceCode());
    }

    /**
     * @return string
     */
    protected static function getRaceAndSubraceCode()
    {
        return self::buildRaceAndSubraceCode(static::getRaceCode(), static::getSubraceCode());
    }

    /**
     * @return string
     */
    public static function getRaceCode()
    {
        if (__CLASS__ === static::class) {
            throw new \LogicException('Call this method on specific race only.');
        }

        return static::RACE_CODE;
    }

    /**
     * @return string
     */
    public static function getSubraceCode()
    {
        if (__CLASS__ === static::class) {
            throw new \LogicException('Call this method on specific race only.');
        }

        return static::SUBRACE_CODE;
    }

    /**
     * @param string $raceCode
     * @param string $subraceCode
     *
     * @return string
     */
    private static function buildRaceAndSubraceCode($raceCode, $subraceCode)
    {
        return "$raceCode-$subraceCode";
    }

    /**
     * @return string
     */
    public static function getTypeName()
    {
        if (static::class === __CLASS__) {
            return parent::getTypeName();
        }

        return static::getRaceAndSubraceCode();
    }

    /**
     * All races can be annotated just as "race" type.
     * The specific race will be build here, distinguished by the race and subrace code.
     * Warning - each specific race has to be registered as a Doctrine type,
     * @see Race::registerSelf()
     *
     * @param string $raceAndSubraceCode
     *
     * @return Race
     */
    protected static function createByValue($raceAndSubraceCode)
    {
        $race = parent::createByValue($raceAndSubraceCode);
        /** @var $race Race */
        if ($race::getRaceAndSubraceCode() !== $raceAndSubraceCode) {
            // create() method, or get() respectively, has to be called on a specific race, not on this abstract one
            throw new Exceptions\UnexpectedRaceCode(
                'Given race-subrace code ' . var_export($raceAndSubraceCode, true) .
                ' results into sub-race ' . get_class($race) . ' with code ' . var_export($race::getRaceAndSubraceCode(), true) . '.'
            );
        }

        return $race;
    }

    /**
     * @param string $raceAndSubraceCode
     *
     * @return string
     */
    protected static function getEnumClass($raceAndSubraceCode)
    {
        $specificRaceClass = parent::getEnumClass($raceAndSubraceCode);
        if ($specificRaceClass === __CLASS__) {
            throw new Exceptions\GenericRaceCanNotBeCreated(
                "Given race and subrace code {$raceAndSubraceCode} is not paired with specific race class"
            );
        }

        return $specificRaceClass;
    }

    public static function registerSelfSubRace()
    {
        return static::addSubTypeEnum(
            static::class,
            '~^' . static::getRaceAndSubraceCode() . '$~'
        );
    }

    /**
     * Get strength modifier
     *
     * @param Gender $gender
     *
     * @return int
     */
    public function getStrengthModifier(Gender $gender)
    {
        $this->checkGenderRace($gender);

        return $this->getBaseStrength() + $gender->getStrengthModifier();
    }

    protected function checkGenderRace(Gender $gender)
    {
        if ($gender::getRaceCode() !== static::getRaceCode()) {
            throw new Exceptions\UnexpectedRace(
                'Given gender of class ' . get_class($gender) . ' is not for race ' . static::getRaceCode() . ', but for race ' . $gender::getRaceCode()
            );
        }
        if ($gender::getSubraceCode() !== static::getSubraceCode()) {
            throw new Exceptions\UnexpectedSubrace(
                'Given gender of class ' . get_class($gender) . ' is not for subrace ' . static::getSubraceCode() . ', but for subrace ' . $gender::getSubraceCode()
            );
        }
    }

    /**
     * @return int
     */
    protected function getBaseStrength()
    {
        return static::BASE_STRENGTH;
    }

    /**
     * Get agility modifier
     *
     * @param Gender $gender
     *
     * @return int
     */
    public function getAgilityModifier(Gender $gender)
    {
        $this->checkGenderRace($gender);

        return $this->getBaseAgility() + $gender->getAgilityModifier();
    }

    /**
     * @return int
     */
    protected function getBaseAgility()
    {
        return static::BASE_AGILITY;
    }

    /**
     * Get knack modifier
     *
     * @param Gender $gender
     *
     * @return int
     */
    public function getKnackModifier(Gender $gender)
    {
        $this->checkGenderRace($gender);

        return $this->getBaseKnack() + $gender->getKnackModifier();
    }

    /**
     * @return int
     */
    protected function getBaseKnack()
    {
        return static::BASE_KNACK;
    }

    /**
     * Get will modifier
     *
     * @param Gender $gender
     *
     * @return int
     */
    public function getWillModifier(Gender $gender)
    {
        $this->checkGenderRace($gender);

        return $this->getBaseWill() + $gender->getWillModifier();
    }

    /**
     * @return int
     */
    protected function getBaseWill()
    {
        return static::BASE_WILL;
    }

    /**
     * Get intelligence modifier
     *
     * @param Gender $gender
     *
     * @return int
     */
    public function getIntelligenceModifier(Gender $gender)
    {
        $this->checkGenderRace($gender);

        return $this->getBaseIntelligence() + $gender->getIntelligenceModifier();
    }

    /**
     * @return int
     */
    protected function getBaseIntelligence()
    {
        return static::BASE_INTELLIGENCE;
    }

    /**
     * Get charisma modifier
     *
     * @param Gender $gender
     *
     * @return int
     */
    public function getCharismaModifier(Gender $gender)
    {
        $this->checkGenderRace($gender);

        return $this->getBaseCharisma() + $gender->getCharismaModifier();
    }

    /**
     * @return int
     */
    protected function getBaseCharisma()
    {
        return static::BASE_CHARISMA;
    }

    /**
     * Get stamina modifier
     *
     * @param Gender $gender
     *
     * @return int
     */
    public function getResistanceModifier(Gender $gender)
    {
        $this->checkGenderRace($gender);

        return $this->getBaseResistance() + $gender->getResistanceModifier();
    }

    /**
     * @return int
     */
    protected function getBaseResistance()
    {
        return static::BASE_RESISTANCE;
    }

    /**
     * Get senses modifier
     *
     * @param Gender $gender
     *
     * @return int
     */
    public function getSensesModifier(Gender $gender)
    {
        $this->checkGenderRace($gender);

        return $this->getBaseSenses() + $gender->getSensesModifier();
    }

    /**
     * @return int
     */
    protected function getBaseSenses()
    {
        return static::BASE_SENSES;
    }

    /**
     * @return int
     */
    public function getToughnessModifier()
    {
        return static::BASE_TOUGHNESS;
    }

    /**
     * @return float
     */
    public function getHeightInCm()
    {
        return static::BASE_HEIGHT_IN_CM;
    }

    /**
     * @return int
     */
    public function getHeightModifier()
    {
        return static::BASE_HEIGHT;
    }

    /**
     * @param Gender $gender
     * @return int
     */
    public function getSizeModifier(Gender $gender)
    {
        return static::BASE_SIZE + $gender->getSizeModifier();
    }

    /**
     * @param Gender $gender
     * @return int
     */
    public function getWeightModifier(Gender $gender)
    {
        return static::BASE_WEIGHT + $gender->getWeightModifier();
    }

    /**
     * @return float
     */
    public function getWeightInKg()
    {
        return static::BASE_WEIGHT_IN_KG;
    }

    /**
     * Can see heat like snakes do?
     *
     * @return bool
     */
    public function hasInfravision()
    {
        return false;
    }

    /**
     * Has bonus to regeneration by nature itself?
     *
     * @return bool
     */
    public function hasNaturalRegeneration()
    {
        return false;
    }

    /**
     * It is so special race so dungeon master agreement is needed to play it?
     * (Races with "star")
     *
     * @return bool
     */
    public function requiresDungeonMasterAgreement()
    {
        return false;
    }

    /**
     * @return false|SenseInterface
     */
    public function getRemarkableSense()
    {
        return false;
    }

}
