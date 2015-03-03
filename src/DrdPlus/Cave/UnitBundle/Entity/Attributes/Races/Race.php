<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races;

use Doctrineum\Strict\String\SelfTypedStrictStringEnum;

/**
 * Race
 */
abstract class Race extends SelfTypedStrictStringEnum
{
    const TYPE_RACE = 'race';

    const BASE_STRENGTH = 0;
    const BASE_AGILITY = 0;
    const BASE_KNACK = 0;
    const BASE_WILL = 0;
    const BASE_INTELLIGENCE = 0;
    const BASE_CHARISMA = 0;
    const BASE_RESISTANCE = 0;
    const BASE_SENSES = 0;

    /**
     * @param string $raceAndSubraceCode
     * @param string $namespace
     * @return Race
     */
    public static function getEnum($raceAndSubraceCode, $namespace = SelfTypedStrictStringEnum::CANNOT_BE_CHANGED_NAMESPACE)
    {
        if (static::class === __CLASS__) {
            // TODO
            throw new \LogicException();
        }
        return parent::getEnum($raceAndSubraceCode, $namespace);
    }

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
     * @return Race
     */
    protected static function createByValue($raceAndSubraceCode)
    {
        static::registerSubraceIfNeeded($raceAndSubraceCode);
        $race = parent::createByValue($raceAndSubraceCode);
        /** @var $race Race */
        if ($race::getRaceAndSubraceCode() !== $raceAndSubraceCode) {
            // create() method, or get() respectively, has to be called on a specific race, not on this abstract one
            throw new Exceptions\UnknownRaceCode(
                'Unknown race-subrace code ' . var_export($raceAndSubraceCode, true) . '. ' .
                'Called from sub-race ' . var_export($race::getRaceAndSubraceCode(), true) . '.'
            );
        }

        return $race;
    }

    /**
     * @param string $raceAndSubraceCode
     * @throws \Doctrine\DBAL\DBALException
     */
    protected static function registerSubraceIfNeeded($raceAndSubraceCode)
    {
        if (!static::hasType($raceAndSubraceCode)) {
            static::addType($raceAndSubraceCode, static::class);
        }
    }

    /**
     * @return Race
     */
    public static function getIt()
    {
        return static::getEnum(static::getRaceAndSubraceCode());
    }

    /**
     * @param string $raceCode
     * @param string $subraceCode
     * @return string
     */
    public static function buildRaceAndSubraceCode($raceCode, $subraceCode)
    {
        return "$raceCode-$subraceCode";
    }

    /**
     * Get strength modifier
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
            throw new \LogicException('Gender is not for race ' . static::getRaceCode() . ', but for race ' . $gender::getRaceCode());
        }
        if ($gender::getSubraceCode() !== static::getSubraceCode()) {
            throw new \LogicException('Gender is not for subrace ' . static::getSubraceCode() . ', but for subrace ' . $gender::getSubraceCode());
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
        throw new Exceptions\MissingRaceCodeImplementation(
            'The gender class ' . static::class . ' has not implemented ' . __METHOD__ . ' method.'
        );
    }

    /**
     * @return string
     */
    public static function getSubraceCode()
    {
        throw new Exceptions\MissingSubraceCodeImplementation(
            'The gender class ' . static::class . ' has not implemented ' . __METHOD__ . ' method.'
        );
    }

}
