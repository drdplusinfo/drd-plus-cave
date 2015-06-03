<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Body\Size;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Derived\DerivedProperty;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Derived\Endurance;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Derived\Senses;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Derived\Speed;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Derived\Toughness;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Gender;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Race;
use DrdPlus\Cave\UnitBundle\Person\Person;
use Granam\Strict\Object\StrictObject;

class PersonProperties extends StrictObject
{
    const INITIAL_PROPERTY_INCREASE_LIMIT = 3;

    /** @var Person */
    private $person;

    /** @var Strength */
    private $strength;

    /** @var Agility */
    private $agility;

    /** @var Knack */
    private $knack;

    /** @var Will */
    private $will;

    /** @var Intelligence */
    private $intelligence;

    /** @var Charisma */
    private $charisma;

    /** @var Toughness */
    private $toughness;

    /** @var Endurance */
    private $endurance;

    /** @var Speed */
    private $speed;

    /** @var Senses */
    private $senses;

    /** @var FirstLevelProperties */
    private $firstLevelProperties;

    /** @var NextLevelsProperties */
    private $nextLevelsProperties;

    /**
     * @param Person $person
     */
    public function __construct(Person $person)
    {
        $this->person = $person;

        $this->firstLevelProperties = new FirstLevelProperties(
            $person->getRace(),
            $person->getGender(),
            $person->getExceptionality()->getExceptionalityProperties(),
            $person->getProfessionLevels()
        );
        $this->nextLevelsProperties = new NextLevelsProperties($person->getProfessionLevels());

        $this->strength = $this->createStrength(
            $this->firstLevelProperties->getFirstLevelStrength(),
            $this->nextLevelsProperties->getNextLevelsStrength()
        );
        $this->agility = $this->createAgility(
            $this->firstLevelProperties->getFirstLevelAgility(),
            $this->nextLevelsProperties->getNextLevelsAgility()
        );
        $this->knack = $this->createKnack(
            $this->firstLevelProperties->getFirstLevelKnack(),
            $this->nextLevelsProperties->getNextLevelsKnack()
        );
        $this->will = $this->createWill(
            $this->firstLevelProperties->getFirstLevelWill(),
            $this->nextLevelsProperties->getNextLevelsWill()
        );
        $this->intelligence = $this->createIntelligence(
            $this->firstLevelProperties->getFirstLevelIntelligence(),
            $this->nextLevelsProperties->getNextLevelsIntelligence()
        );
        $this->charisma = $this->createCharisma(
            $this->firstLevelProperties->getFirstLevelCharisma(),
            $this->nextLevelsProperties->getNextLevelsCharisma()
        );

        $this->setUpDerivedProperty($this->createToughness($this->getStrength(), $person->getRace()));
        $this->setUpDerivedProperty($this->createEndurance($this->getStrength(), $this->getWill()));
        $this->setUpDerivedProperty($this->createSpeed($this->getStrength(), $this->getAgility()));
        $this->setUpDerivedProperty($this->createSenses($this->getKnack(), $person->getRace(), $person->getGender()));
    }

    private function createStrength(Strength $firstLevelStrength, Strength $nextLevelsStrength)
    {
        return Strength::getIt($firstLevelStrength->getValue() + $nextLevelsStrength->getValue());
    }

    private function createAgility(Agility $firstLevelAgility, Agility $nextLevelsAgility)
    {
        return Agility::getIt($firstLevelAgility->getValue() + $nextLevelsAgility->getValue());
    }

    private function createKnack(Knack $firstLevelKnack, Knack $nextLevelsKnack)
    {
        return Knack::getIt($firstLevelKnack->getValue() + $nextLevelsKnack->getValue());
    }

    private function createWill(Will $firstLevelWill, Will $nextLevelsWill)
    {
        return Will::getIt($firstLevelWill->getValue() + $nextLevelsWill->getValue());
    }

    private function createIntelligence(Intelligence $firstLevelIntelligence, Intelligence $nextLevelsIntelligence)
    {
        return Intelligence::getIt($firstLevelIntelligence->getValue() + $nextLevelsIntelligence->getValue());
    }

    private function createCharisma(Charisma $firstLevelCharisma, Charisma $nextLevelsCharisma)
    {
        return Charisma::getIt($firstLevelCharisma->getValue() + $nextLevelsCharisma->getValue());
    }

    private function createToughness(Strength $strength, Race $race)
    {
        return new Toughness(
            $strength->getValue()
            + $race->getToughnessModifier()
        );
    }

    private function createEndurance(Strength $strength, Will $will)
    {
        return new Endurance((int)round($strength->getValue() + $will->getValue()));
    }

    private function createSpeed(Strength $strength, Agility $agility)
    {
        return new Speed($this->calculateSpeed($strength, $agility));
    }

    private function calculateSpeed(Strength $strength, Agility $agility)
    {
        return
            round(($strength->getValue() + $agility->getValue()) / 2)
            + $this->getSpeedBonusBySize($this->getSize());
    }

    private function getSpeedBonusBySize(Size $size)
    {
        if ($size->getValue() > 0) {
            // 1 - 3 = -1; 4 - 6 = 0; 7 - 9 = +1 ...
            return ceil($size->getValue() / 3) - 2;
        }

        // -2 - 0 = -2 ...
        return floor(($size->getValue() - 1) / 3) - 1;
    }

    private function createSenses(Knack $knack, Race $race, Gender $gender)
    {
        return new Senses($this->calculateSenses($knack, $race, $gender));
    }

    private function calculateSenses(Knack $knack, Race $race, Gender $gender)
    {
        return $knack->getValue() + $race->getSensesModifier($gender);
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
    public function getStrength()
    {
        return $this->strength;
    }

    /**
     * @param DerivedProperty $derivedProperty
     *
     * @throws Exceptions\PropertyIsAlreadySet
     */
    private function setUpDerivedProperty(DerivedProperty $derivedProperty)
    {
        $derivedPropertyName = $derivedProperty->getName();
        if (isset($this->$derivedPropertyName)) {
            throw new Exceptions\PropertyIsAlreadySet(
                'The property ' . $derivedPropertyName . ' is already set by value ' . var_export($this->$derivedPropertyName->getValue(), true)
            );
        }

        $this->$derivedPropertyName = $derivedProperty;
    }

    /**
     * @return Agility
     */
    public function getAgility()
    {
        return $this->agility;
    }

    /**
     * @return Knack
     */
    public function getKnack()
    {
        return $this->knack;
    }

    /**
     * @return Will
     */
    public function getWill()
    {
        return $this->will;
    }

    /**
     * @return Intelligence
     */
    public function getIntelligence()
    {
        return $this->intelligence;
    }

    /**
     * @return Charisma
     */
    public function getCharisma()
    {
        return $this->charisma;
    }

    /**
     * @return Toughness
     */
    public function getToughness()
    {
        return $this->toughness;
    }

    /**
     * @return Endurance
     */
    public function getEndurance()
    {
        return $this->endurance;
    }

    /**
     * @return Speed
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * @return Size
     */
    public function getSize()
    {
        // there is no more size increment than the first level one
        return $this->firstLevelProperties->getFirstLevelSize();
    }

    /**
     * @return Senses
     */
    public function getSenses()
    {
        return $this->senses;
    }

}
