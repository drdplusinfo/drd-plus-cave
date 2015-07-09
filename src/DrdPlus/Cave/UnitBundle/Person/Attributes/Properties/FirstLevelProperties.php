<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties;

use DrdPlus\Cave\TablesBundle\Tables\Tables;
use DrdPlus\Cave\TablesBundle\Tables\Weight\WeightTable;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\ExceptionalityProperties;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Body\Size;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Body\WeightInKg;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Parts\BaseProperty;
use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevels;
use DrdPlus\Cave\UnitBundle\Person\Races\Gender;
use DrdPlus\Cave\UnitBundle\Person\Races\Race;
use Granam\Strict\Object\StrictObject;

class FirstLevelProperties extends StrictObject
{
    const INITIAL_PROPERTY_INCREASE_LIMIT = 3;

    /** @var Strength */
    private $firstLevelUnlimitedStrength;
    /** @var Strength */
    private $firstLevelStrength;
    /** @var Agility */
    private $firstLevelUnlimitedAgility;
    /** @var Agility */
    private $firstLevelAgility;
    /** @var Knack */
    private $firstLevelUnlimitedKnack;
    /** @var Knack */
    private $firstLevelKnack;
    /** @var Will */
    private $firstLevelUnlimitedWill;
    /** @var Will */
    private $firstLevelWill;
    /** @var Intelligence */
    private $firstLevelUnlimitedIntelligence;
    /** @var Intelligence */
    private $firstLevelIntelligence;
    /** @var Charisma */
    private $firstLevelUnlimitedCharisma;
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
            + $this->getPropertyModifierForFirstProfession($professionLevels, $propertyName);
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

    private function getPropertyModifierForFirstProfession(ProfessionLevels $professionLevels, $propertyName)
    {
        switch ($propertyName) {
            case Strength::STRENGTH :
                return $professionLevels->getStrengthModifierForFirstProfession();
            case Agility::AGILITY :
                return $professionLevels->getAgilityModifierForFirstProfession();
            case Knack::KNACK :
                return $professionLevels->getKnackModifierForFirstProfession();
            case Will::WILL :
                return $professionLevels->getWillModifierForFirstProfession();
            case Intelligence::INTELLIGENCE :
                return $professionLevels->getIntelligenceModifierForFirstProfession();
            case Charisma::CHARISMA :
                return $professionLevels->getCharismaModifierForFirstProfession();
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
     * @param BaseProperty $firstLevelUnlimitedProperty
     * @param Race $race
     * @param Gender $gender
     *
     * @throws Exceptions\PropertyIsAlreadySet
     */
    private function setUpBaseProperty(BaseProperty $firstLevelUnlimitedProperty, Race $race, Gender $gender)
    {
        $propertyName = $firstLevelUnlimitedProperty->getName();
        if (!is_null($this->getFirstLevelProperty($propertyName))) {
            throw new Exceptions\PropertyIsAlreadySet(
                'The property "firstLevel' . ucfirst($propertyName) . '"" is already set by value ' . var_export($this->getFirstLevelProperty($propertyName), true)
            );
        }

        switch ($propertyName) {
            case Strength::STRENGTH :
                $this->firstLevelUnlimitedStrength = $firstLevelUnlimitedProperty;
                $this->firstLevelStrength = $this->getLimitedProperty($firstLevelUnlimitedProperty, $race, $gender);
                break;
            case Agility::AGILITY :
                $this->firstLevelUnlimitedAgility = $firstLevelUnlimitedProperty;
                $this->firstLevelAgility = $this->getLimitedProperty($firstLevelUnlimitedProperty, $race, $gender);
                break;
            case Knack::KNACK :
                $this->firstLevelUnlimitedKnack = $firstLevelUnlimitedProperty;
                $this->firstLevelKnack = $this->getLimitedProperty($firstLevelUnlimitedProperty, $race, $gender);
                break;
            case Will::WILL :
                $this->firstLevelUnlimitedWill = $firstLevelUnlimitedProperty;
                $this->firstLevelWill = $this->getLimitedProperty($firstLevelUnlimitedProperty, $race, $gender);
                break;
            case Intelligence::INTELLIGENCE :
                $this->firstLevelUnlimitedIntelligence = $firstLevelUnlimitedProperty;
                $this->firstLevelIntelligence = $this->getLimitedProperty($firstLevelUnlimitedProperty, $race, $gender);
                break;
            case Charisma::CHARISMA :
                $this->firstLevelUnlimitedCharisma = $firstLevelUnlimitedProperty;
                $this->firstLevelCharisma = $this->getLimitedProperty($firstLevelUnlimitedProperty, $race, $gender);
                break;
            default :
                throw new \LogicException;
        }
    }

    /**
     * @param BaseProperty $baseProperty
     * @param Race $race
     * @param Gender $gender
     * @return Agility|Charisma|Intelligence|Knack|Strength|Will
     */
    private function getLimitedProperty(BaseProperty $baseProperty, Race $race, Gender $gender)
    {
        $limit = $this->calculateMaximalBasePropertyValue($baseProperty->getName(), $race, $gender);
        if ($baseProperty->getValue() <= $limit) {
            return $baseProperty;
        }

        switch ($baseProperty->getName()) {
            case Strength::STRENGTH :
                return Strength::getIt($limit);
            case Agility::AGILITY :
                return Agility::getIt($limit);
            case Knack::KNACK :
                return Knack::getIt($limit);
            case Will::WILL :
                return Will::getIt($limit);
            case Intelligence::INTELLIGENCE :
                return Intelligence::getIt($limit);
            case Charisma::CHARISMA :
                return Charisma::getIt($limit);
            default :
                throw new \LogicException;
        }
    }

    private function getFirstLevelProperty($propertyName)
    {
        switch ($propertyName) {
            case Strength::STRENGTH :
                return $this->firstLevelStrength;
            case Agility::AGILITY :
                return $this->firstLevelAgility;
            case Knack::KNACK :
                return $this->firstLevelKnack;
            case Will::WILL :
                return $this->firstLevelWill;
            case Intelligence::INTELLIGENCE :
                return $this->firstLevelIntelligence;
            case Charisma::CHARISMA :
                return $this->firstLevelCharisma;
            default :
                throw new \LogicException;
        }
    }

    /**
     * @param string $propertyName
     * @param Race $race
     * @param Gender $gender
     *
     * @return int
     */
    private function calculateMaximalBasePropertyValue($propertyName, Race $race, Gender $gender)
    {
        return $this->getRacePropertyModifier($race, $gender, $propertyName) + self::INITIAL_PROPERTY_INCREASE_LIMIT;
    }

    /**
     * @return int 0+
     */
    public function getStrengthLossBecauseOfLimit()
    {
        return $this->firstLevelUnlimitedStrength->getValue() - $this->getFirstLevelStrength()->getValue();
    }

    /**
     * @return int 0+
     */
    public function getAgilityLossBecauseOfLimit()
    {
        return $this->firstLevelUnlimitedAgility->getValue() - $this->getFirstLevelAgility()->getValue();
    }

    /**
     * @return int 0+
     */
    public function getKnackLossBecauseOfLimit()
    {
        return $this->firstLevelUnlimitedKnack->getValue() - $this->getFirstLevelKnack()->getValue();
    }

    /**
     * @return int 0+
     */
    public function getWillLossBecauseOfLimit()
    {
        return $this->firstLevelUnlimitedWill->getValue() - $this->getFirstLevelWill()->getValue();
    }

    /**
     * @return int 0+
     */
    public function getIntelligenceLossBecauseOfLimit()
    {
        return $this->firstLevelUnlimitedIntelligence->getValue() - $this->getFirstLevelIntelligence()->getValue();
    }

    /**
     * @return int 0+
     */
    public function getCharismaLossBecauseOfLimit()
    {
        return $this->firstLevelUnlimitedCharisma->getValue() - $this->getFirstLevelCharisma()->getValue();
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
            + $professionLevels->getStrengthModifierForFirstProfession();
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
