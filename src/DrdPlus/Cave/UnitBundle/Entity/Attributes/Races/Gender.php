<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races;

use Doctrineum\Enum;

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
     * @param string $raceGenderCode
     * @param string $innerNamespace
     * @return Gender
     */
    public static function get($raceGenderCode, $innerNamespace = self::INNER_NAMESPACE){
        parent::get($raceGenderCode, $innerNamespace);
    }

    /**
     * @param string $raceGenderCode
     * @return Gender
     */
    protected static function create($raceGenderCode)
    {
        $gender = parent::create($raceGenderCode);
        /** @var $gender Gender */
        if ($gender->getRaceGenderCode() !== $raceGenderCode) {
            throw new Exceptions\UnknownGenderCode('Unknown gender code ' . var_export($raceGenderCode, true) . '. Has been this method called from specific gender class?');
        }

        return $raceGenderCode;
    }

    /**
     * @return string
     */
    protected function getRaceGenderCode()
    {
        return $this->getRaceCode() . '-' . $this->getGenderCode();
    }

    /**
     * @return string
     */
    abstract public function getRaceCode();

    /**
     * @return string
     */
    protected function getGenderCode()
    {
        return $this->isMale()
            ? self::MALE_CODE
            : self::FEMALE_CODE;
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
