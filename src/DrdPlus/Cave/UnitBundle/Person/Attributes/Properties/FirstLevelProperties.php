<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties;

use DrdPlus\Cave\TablesBundle\Tables\Tables;
use DrdPlus\Cave\TablesBundle\Tables\Weight\WeightTable;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\ExceptionalityProperties;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Body\Size;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Body\WeightInKg;
use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevels;
use DrdPlus\Cave\UnitBundle\Person\Races\Gender;
use DrdPlus\Cave\UnitBundle\Person\Races\Race;
use Granam\Strict\Object\StrictObject;

class FirstLevelProperties extends StrictObject
{
    const INITIAL_PROPERTY_INCREASE_LIMIT = 3;

    /** @var Strength */
    private $firstLevelStrength;

    /** @var Agility */
    private $firstLevelAgility;

    /** @var Knack */
    private $firstLevelKnack;

    /** @var Will */
    private $firstLevelWill;

    /** @var Intelligence */
    private $firstLevelIntelligence;

    /** @var Charisma */
    private $firstLevelCharisma;

    /** @var WeightInKg */
    private $firstLevelWeightInKg;

    /** @var Size */
    private $firstLevelSize;

    public function __construct(
        Race $race,
        Gender $gender,
        ExceptionalityProperties $exceptionalityProperties,
        ProfessionLevels $professionLevels,
        Tables $tables
    )
    {
        $this->setUpBaseProperty($this->createFirstLevelStrength($race, $gender, $exceptionalityProperties, $professionLevels), $race, $gender);
        $this->setUpBaseProperty($this->createFirstLevelAgility($race, $gender, $exceptionalityProperties, $professionLevels), $race, $gender);
        $this->setUpBaseProperty($this->createFirstLevelKnack($race, $gender, $exceptionalityProperties, $professionLevels), $race, $gender);
        $this->setUpBaseProperty($this->createFirstLevelWill($race, $gender, $exceptionalityProperties, $professionLevels), $race, $gender);
        $this->setUpBaseProperty($this->createFirstLevelIntelligence($race, $gender, $exceptionalityProperties, $professionLevels), $race, $gender);
        $this->setUpBaseProperty($this->createFirstLevelCharisma($race, $gender, $exceptionalityProperties, $professionLevels), $race, $gender);
        $this->firstLevelWeightInKg = $this->createFirstLevelWeightInKg($race, $gender, $tables->getWeightTable(), $professionLevels);
        $this->firstLevelSize = $this->createFirstLevelSize($race, $gender, $exceptionalityProperties, $professionLevels);
    }

    private function createFirstLevelStrength(
        Race $race,
        Gender $gender,
        ExceptionalityProperties $exceptionalityProperties,
        ProfessionLevels $professionLevels
    )
    {
        return Strength::getIt(
            $this->calculateFirstLevelBaseProperty(Strength::STRENGTH, $race, $gender, $exceptionalityProperties, $professionLevels)
        );
    }

    private function calculateFirstLevelBaseProperty(
        $propertyName,
        Race $race,
        Gender $gender,
        ExceptionalityProperties $exceptionalityProperties,
        ProfessionLevels $professionLevels
    )
    {
        return
            $this->getRacePropertyModifier($race, $gender, $propertyName)
            + $this->getExceptionalPropertyIncrement($propertyName, $exceptionalityProperties)->getValue()
            + $this->getPropertyModifierForFirstLevel($professionLevels, $propertyName);
    }

    private function getRacePropertyModifier(Race $race, Gender $gender, $propertyName)
    {
        switch ($propertyName) {
            case Strength::STRENGTH :
                return $race->getStrengthModifier($gender);
            case Agility::AGILITY :
                return $race->getAgilityModifier($gender);
            case Knack::KNACK :
                return $race->getKnackModifier($gender);
            case Will::WILL :
                return $race->getWillModifier($gender);
            case Intelligence::INTELLIGENCE :
                return $race->getIntelligenceModifier($gender);
            case Charisma::CHARISMA :
                return $race->getCharismaModifier($gender);
            default :
                throw new \LogicException;
        }
    }

    private function getPropertyModifierForFirstLevel(ProfessionLevels $professionLevels, $propertyName)
    {
        switch ($propertyName) {
            case Strength::STRENGTH :
                return $professionLevels->getStrengthModifierForFirstLevel();
            case Agility::AGILITY :
                return $professionLevels->getAgilityModifierForFirstLevel();
            case Knack::KNACK :
                return $professionLevels->getKnackModifierForFirstLevel();
            case Will::WILL :
                return $professionLevels->getWillModifierForFirstLevel();
            case Intelligence::INTELLIGENCE :
                return $professionLevels->getIntelligenceModifierForFirstLevel();
            case Charisma::CHARISMA :
                return $professionLevels->getCharismaModifierForFirstLevel();
            default :
                throw new \LogicException;
        }
    }

    /**
     * @param $propertyName
     * @param ExceptionalityProperties $exceptionalityProperties
     *
     * @return BaseProperty
     */
    private function getExceptionalPropertyIncrement($propertyName, ExceptionalityProperties $exceptionalityProperties)
    {
        switch ($propertyName) {
            case Strength::STRENGTH :
                return $exceptionalityProperties->getStrength();
            case Agility::AGILITY :
                return $exceptionalityProperties->getAgility();
            case Knack::KNACK :
                return $exceptionalityProperties->getKnack();
            case Will::WILL :
                return $exceptionalityProperties->getWill();
            case Intelligence::INTELLIGENCE :
                return $exceptionalityProperties->getIntelligence();
            case Charisma::CHARISMA :
                return $exceptionalityProperties->getCharisma();
            default :
                throw new \LogicException;
        }
    }

    /**
     * @param BaseProperty $firstLevelProperty
     * @param Race $race
     * @param Gender $gender
     *
     * @throws Exceptions\PropertyIsAlreadySet
     * @throws Exceptions\BasePropertyValueExceeded
     */
    private function setUpBaseProperty(BaseProperty $firstLevelProperty, Race $race, Gender $gender)
    {
        $propertyName = $firstLevelProperty->getName();
        // like firstLevelStrength
        $firstLevelPropertyName = 'firstLevel' . ucfirst($propertyName);
        if (isset($this->$firstLevelPropertyName)) {
            throw new Exceptions\PropertyIsAlreadySet(
                'The property ' . $firstLevelPropertyName . ' is already set by value ' . var_export($this->$firstLevelPropertyName->getValue(), true)
            );
        }

        if ($firstLevelProperty->getValue() > $this->calculateMaximalBaseProperty($propertyName, $race, $gender)) {
            throw new Exceptions\BasePropertyValueExceeded(
                'The firstLevel ' . $propertyName . ' can not exceed ' .
                $this->calculateMaximalBaseProperty($propertyName, $race, $gender) . '. Got ' . $firstLevelProperty->getValue() . '.'
            );
        }

        $this->$firstLevelPropertyName = $firstLevelProperty;
    }

    /**
     * @param string $propertyName
     * @param Race $race
     * @param Gender $gender
     *
     * @return int
     */
    private function calculateMaximalBaseProperty($propertyName, Race $race, Gender $gender)
    {
        return $this->getRacePropertyModifier($race, $gender, $propertyName) + self::INITIAL_PROPERTY_INCREASE_LIMIT;
    }

    private function createFirstLevelAgility(Race $race, Gender $gender, ExceptionalityProperties $exceptionalityProperties, ProfessionLevels $professionLevels)
    {
        return Agility::getIt($this->calculateFirstLevelBaseProperty(Agility::AGILITY, $race, $gender, $exceptionalityProperties, $professionLevels));
    }

    private function createFirstLevelKnack(Race $race, Gender $gender, ExceptionalityProperties $exceptionalityProperties, ProfessionLevels $professionLevels)
    {
        return Knack::getIt($this->calculateFirstLevelBaseProperty(Knack::KNACK, $race, $gender, $exceptionalityProperties, $professionLevels));
    }

    private function createFirstLevelWill(Race $race, Gender $gender, ExceptionalityProperties $exceptionalityProperties, ProfessionLevels $professionLevels)
    {
        return Will::getIt($this->calculateFirstLevelBaseProperty(Will::WILL, $race, $gender, $exceptionalityProperties, $professionLevels));
    }

    private function createFirstLevelIntelligence(Race $race, Gender $gender, ExceptionalityProperties $exceptionalityProperties, ProfessionLevels $professionLevels)
    {
        return Intelligence::getIt($this->calculateFirstLevelBaseProperty(Intelligence::INTELLIGENCE, $race, $gender, $exceptionalityProperties, $professionLevels));
    }

    private function createFirstLevelCharisma(Race $race, Gender $gender, ExceptionalityProperties $exceptionalityProperties, ProfessionLevels $professionLevels)
    {
        return Charisma::getIt($this->calculateFirstLevelBaseProperty(Charisma::CHARISMA, $race, $gender, $exceptionalityProperties, $professionLevels));
    }

    private function createFirstLevelWeightInKg(Race $race, Gender $gender, WeightTable $weightTable, ProfessionLevels $professionLevels)
    {
        return WeightInKg::getIt($race->getWeightInKg($gender, $weightTable) + $professionLevels->getWeightKgModifierForFirstLevel());
    }

    private function createFirstLevelSize(Race $race, Gender $gender, ExceptionalityProperties $exceptionalityProperties, ProfessionLevels $professionLevels)
    {
        return new Size($this->calculateFirstLevelSize($race, $gender, $exceptionalityProperties, $professionLevels));
    }

    private function calculateFirstLevelSize(Race $race, Gender $gender, ExceptionalityProperties $exceptionalityProperties, ProfessionLevels $professionLevels)
    {
        return
            $race->getSizeModifier($gender)
            + $this->getFirstLevelSizeBonusByStrengthIncrement(
                $this->getFirstLevelStrengthIncrementSummary($exceptionalityProperties, $professionLevels)
            );
    }

    private function getFirstLevelSizeBonusByStrengthIncrement($firstLevelStrengthIncrement)
    {
        if ($firstLevelStrengthIncrement === 0) {
            return -1;
        }
        if ($firstLevelStrengthIncrement >= 2) {
            return +1;
        }
        if ($firstLevelStrengthIncrement === 1) {
            return 0;
        }
        throw new \LogicException('FirstLevel strength increment can not be lesser than zero. Given ' . $firstLevelStrengthIncrement);
    }

    private function getFirstLevelStrengthIncrementSummary(ExceptionalityProperties $exceptionalityProperties, ProfessionLevels $professionLevels)
    {
        return // the race bonus is NOT count for incrementation, doesn't count to size respectively
            $exceptionalityProperties->getStrength()->getValue()
            + $professionLevels->getStrengthModifierForFirstLevel();
    }

    /**
     * @return Strength
     */
    public function getFirstLevelStrength()
    {
        return $this->firstLevelStrength;
    }

    /**
     * @return Agility
     */
    public function getFirstLevelAgility()
    {
        return $this->firstLevelAgility;
    }

    /**
     * @return Knack
     */
    public function getFirstLevelKnack()
    {
        return $this->firstLevelKnack;
    }

    /**
     * @return Will
     */
    public function getFirstLevelWill()
    {
        return $this->firstLevelWill;
    }

    /**
     * @return Intelligence
     */
    public function getFirstLevelIntelligence()
    {
        return $this->firstLevelIntelligence;
    }

    /**
     * @return Charisma
     */
    public function getFirstLevelCharisma()
    {
        return $this->firstLevelCharisma;
    }

    /**
     * @return WeightInKg
     */
    public function getFirstLevelWeightInKg()
    {
        return $this->firstLevelWeightInKg;
    }

    /**
     * @return Size
     */
    public function getFirstLevelSize()
    {
        return $this->firstLevelSize;
    }


}
