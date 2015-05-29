<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Derived\DerivedProperty;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Derived\Endurance;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Derived\Toughness;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Race;
use DrdPlus\Cave\UnitBundle\Person\Person;
use Granam\Strict\Object\StrictObject;

class BaseProperties extends StrictObject
{
    const INITIAL_PROPERTY_INCREASE_LIMIT = 3;

    /**
     * @var Person
     */
    private $person;

    /**
     * @var Strength
     */
    private $baseStrength;

    /**
     * @var Agility
     */
    private $baseAgility;

    /**
     * @var Knack
     */
    private $baseKnack;

    /**
     * @var Will
     */
    private $baseWill;

    /**
     * @var Intelligence
     */
    private $baseIntelligence;

    /**
     * @var Charisma
     */
    private $baseCharisma;

    /**
     * @var Toughness
     */
    private $baseToughness;

    /**
     * @var Endurance
     */
    private $baseEndurance;

    public function __construct(Person $person)
    {
        $this->person = $person;
        $this->setUpBaseProperty($this->createBaseStrength($person), $person);
        $this->setUpBaseProperty($this->createBaseAgility($person), $person);
        $this->setUpBaseProperty($this->createBaseKnack($person), $person);
        $this->setUpBaseProperty($this->createBaseWill($person), $person);
        $this->setUpBaseProperty($this->createBaseIntelligence($person), $person);
        $this->setUpBaseProperty($this->createBaseCharisma($person), $person);
        $this->setUpDerivedProperty($this->createBaseToughness($this->getBaseStrength(), $person->getRace()));
        $this->setUpDerivedProperty($this->createBaseEndurance($this->getBaseStrength(), $this->getBaseWill()));
        $this->setUpDerivedProperty($this->createBaseSpeed($this->getBaseStrength(), $this->getBaseAgility()), $this->getPerson());
    }

    private function createBaseStrength(Person $person)
    {
        return Strength::getIt($this->calculateBaseProperty(Strength::STRENGTH, $person));
    }

    private function calculateBaseProperty($propertyName, Person $person)
    {
        /** @var string|BaseProperty $propertyName */
        $propertyName = ucfirst($propertyName);
        $propertyModifierGetter = "get{$propertyName}Modifier";
        $propertyGetter = "get{$propertyName}";
        $propertyFirstLevelIncrementGetter = "get{$propertyName}FirstLevelIncrement";

        return
            $person->getRace()->$propertyModifierGetter($this->getPerson()->getGender())
            + $person->getExceptionality()->getExceptionalityProperties()->$propertyGetter()->getValue()
            + $person->getProfessionLevels()->$propertyFirstLevelIncrementGetter();
    }

    /**
     * @param BaseProperty $baseProperty
     * @param Person $person
     *
     * @throws Exceptions\BasePropertyIsAlreadySet
     * @throws Exceptions\BasePropertyValueExceeded
     */
    private function setUpBaseProperty(BaseProperty $baseProperty, Person $person)
    {
        $propertyName = $baseProperty->getName();
        // like baseStrength
        $basePropertyName = 'base' . ucfirst($propertyName);
        if (isset($this->$basePropertyName)) {
            throw new Exceptions\BasePropertyIsAlreadySet(
                'The property ' . $basePropertyName . ' is already set by value ' . var_export($this->$basePropertyName->getValue(), true)
            );
        }

        if ($baseProperty->getValue() > $this->calculateMaximalBaseProperty($propertyName, $person)) {
            throw new Exceptions\BasePropertyValueExceeded(
                'The base ' . $propertyName . ' can not exceed ' . $this->calculateMaximalBaseProperty($propertyName, $person)
            );
        }

        $this->$basePropertyName = $baseProperty;
    }

    /**
     * @param string $propertyName
     * @param Person $person
     *
     * @return int
     */
    private function calculateMaximalBaseProperty($propertyName, Person $person)
    {
        // like getStrengthModifier()
        $propertyModifierGetter = 'get' . ucfirst($propertyName) . 'Modifier';

        return self::INITIAL_PROPERTY_INCREASE_LIMIT + $person->getRace()->$propertyModifierGetter($person->getGender());
    }

    private function createBaseAgility(Person $person)
    {
        return Agility::getIt($this->calculateBaseProperty(Agility::AGILITY, $person));
    }

    private function createBaseKnack(Person $person)
    {
        return Knack::getIt($this->calculateBaseProperty(Knack::KNACK, $person));
    }

    private function createBaseWill(Person $person)
    {
        return Will::getIt($this->calculateBaseProperty(Will::WILL, $person));
    }

    private function createBaseIntelligence(Person $person)
    {
        return Intelligence::getIt($this->calculateBaseProperty(Intelligence::INTELLIGENCE, $person));
    }

    private function createBaseCharisma(Person $person)
    {
        return Charisma::getIt($this->calculateBaseProperty(Charisma::CHARISMA, $person));
    }

    private function createBaseToughness(Strength $baseStrength, Race $race)
    {
        return Toughness::getIt(
            $baseStrength->getValue()
            + $race->getToughnessModifier()
        );
    }

    private function createBaseEndurance(Strength $baseStrength, Will $baseWill)
    {
        return Toughness::getIt(round($baseStrength->getValue() + $baseWill->getValue()));
    }

    /**
     * @return Person
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * @return Strength
     */
    public function getBaseStrength()
    {
        return $this->baseStrength;
    }

    /**
     * @param DerivedProperty $derivedProperty
     *
     * @throws Exceptions\BasePropertyIsAlreadySet
     * @throws Exceptions\BasePropertyValueExceeded
     */
    private function setUpDerivedProperty(DerivedProperty $derivedProperty)
    {
        $propertyName = $derivedProperty->getName();
        // like baseToughness
        $derivedBasePropertyName = 'base' . ucfirst($propertyName);
        if (isset($this->$derivedBasePropertyName)) {
            throw new Exceptions\BasePropertyIsAlreadySet(
                'The property ' . $derivedBasePropertyName . ' is already set by value ' . var_export($this->$derivedBasePropertyName->getValue(), true)
            );
        }

        $this->$derivedBasePropertyName = $derivedProperty;
    }

    /**
     * @return Agility
     */
    public function getBaseAgility()
    {
        return $this->baseAgility;
    }

    /**
     * @return Knack
     */
    public function getBaseKnack()
    {
        return $this->baseKnack;
    }

    /**
     * @return Will
     */
    public function getBaseWill()
    {
        return $this->baseWill;
    }

    /**
     * @return Intelligence
     */
    public function getBaseIntelligence()
    {
        return $this->baseIntelligence;
    }

    /**
     * @return Charisma
     */
    public function getBaseCharisma()
    {
        return $this->baseCharisma;
    }

    /**
     * @return Toughness
     */
    public function getBaseToughness()
    {
        return $this->baseToughness;
    }

    /**
     * @return Endurance
     */
    public function getBaseEndurance()
    {
        return $this->baseEndurance;
    }

}
