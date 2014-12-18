<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races;

use Doctrineum\Enum;
use DrdPlus\Cave\UnitBundle\Enum\Races\Genders\Gender;

/**
 * Race
 */
abstract class Race extends Enum
{

    /** overloaded parent value to get own namespace */
    const INNER_NAMESPACE = __CLASS__;

    /**
     * Get strength modifier
     * @param Gender $gender
     *
     * @return int
     */
    public function getStrengthModifier(Gender $gender)
    {
        return $this->getBaseStrength() + $gender->getStrengthModifier();
    }

    /**
     * @return int
     */
    abstract protected function getBaseStrength();

    /**
     * Get agility modifier
     * @param Gender $gender
     *
     * @return int
     */
    public function getAgilityModifier(Gender $gender)
    {
        return $this->getBaseAgility() + $gender->getAgilityModifier();
    }

    /**
     * @return int
     */
    abstract protected function getBaseAgility();

    /**
     * Get knack modifier
     * @param Gender $gender
     *
     * @return int
     */
    public function getKnackModifier(Gender $gender)
    {
        return $this->getBaseKnack() + $gender->getKnackModifier();
    }

    /**
     * @return int
     */
    abstract protected function getBaseKnack();

    /**
     * Get will modifier
     * @param Gender $gender
     *
     * @return int
     */
    public function getWillModifier(Gender $gender)
    {
        return $this->getBaseWill() + $gender->getWillModifier();
    }

    /**
     * @return int
     */
    abstract protected function getBaseWill();

    /**
     * Get intelligence modifier
     * @param Gender $gender
     *
     * @return int
     */
    public function getIntelligenceModifier(Gender $gender)
    {
        return $this->getBaseIntelligence() + $gender->getIntelligenceModifier();
    }

    /**
     * @return int
     */
    abstract protected function getBaseIntelligence();

    /**
     * Get charisma modifier
     * @param Gender $gender
     *
     * @return int
     */
    public function getCharismaModifier(Gender $gender) {
        return $this->getBaseCharisma() + $gender->getCharismaModifier();
    }

    /**
     * @return int
     */
    abstract protected function getBaseCharisma();

    /**
     * Get stamina modifier
     * @param Gender $gender
     *
     * @return int
     */
    public function getResistanceModifier(Gender $gender) {
        return $this->getBaseResistance() + $gender->getResistanceModifier();
    }

    /**
     * @return int
     */
    abstract protected function getBaseResistance();

    /**
     * Get senses modifier
     * @param Gender $gender
     *
     * @return int
     */
    public function getSensesModifier(Gender $gender) {
        return $this->getBaseSenses() + $gender->getSensesModifier();
    }

    /**
     * @return int
     */
    abstract protected function getBaseSenses();

    /**
     * Can see heat like snakes do?
     *
     * @return bool
     */
    abstract public function hasInfravision();

    /**
     * Has bonus to regeneration by nature itself?
     *
     * @return bool
     */
    abstract public function hasNaturalRegeneration();

    /**
     * It is so special race so dungeon master agreement is needed to play it?
     * (Races with "star")
     *
     * @return true
     */
    abstract public function requiresDungeonMasterAgreement();

    /**
     * Call this method on specific race, not on this abstract class (it is prohibited by exception raising anyway)
     * @see create
     *
     * @param string $raceCode
     * @return Race|null
     */
    public static function get($raceCode)
    {
        parent::get($raceCode, self::INNER_NAMESPACE);
    }

    /**
     * @param string $raceCode
     * @return Race
     */
    protected static function create($raceCode)
    {
        $race = parent::create($raceCode);
        /** @var $race Race */
        if ($race->getRaceCode() !== $raceCode) {
            // create() method, or get() respectively, has to be called on a specific race, not on this abstract one
            throw new Exceptions\UnknownRaceCode('Unknown race code ' . var_export($raceCode, true) . '. Has been this method called from specific race class?');
        }

        return $raceCode;
    }

    /**
     * @return string
     */
    abstract protected function getRaceCode();
}
