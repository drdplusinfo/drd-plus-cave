<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties;

use DrdPlus\Cave\TablesBundle\Tables\Tables;
use DrdPlus\Cave\UnitBundle\Person\Attributes\GameCharacteristics\Combat\Attack;
use DrdPlus\Cave\UnitBundle\Person\Attributes\GameCharacteristics\Combat\Defense;
use DrdPlus\Cave\UnitBundle\Person\Attributes\GameCharacteristics\Combat\Fight;
use DrdPlus\Cave\UnitBundle\Person\Attributes\GameCharacteristics\Combat\Shooting;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Body\Size;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Body\WeightInKg;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Derived\Endurance;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Derived\Senses;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Derived\Speed;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Derived\Toughness;
use DrdPlus\Cave\UnitBundle\Person\Person;
use Granam\Strict\Object\StrictObject;

class PersonProperties extends StrictObject
{

    /** @var FirstLevelProperties */
    private $firstLevelProperties;

    /** @var NextLevelsProperties */
    private $nextLevelsProperties;

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

    /** @var WeightInKg */
    private $weightInKg;

    /** @var Toughness */
    private $toughness;

    /** @var Endurance */
    private $endurance;

    /** @var Speed */
    private $speed;

    /** @var Size */
    private $size;

    /** @var Senses */
    private $senses;

    /** @var Fight */
    private $fight;

    /** @var Attack */
    private $attack;

    /** @var Defense */
    private $defense;

    /** @var Shooting */
    private $shooting;

    /**
     * @param Person $person
     * @param Tables $tables
     */
    public function __construct(Person $person, Tables $tables)
    {
        $this->firstLevelProperties = new FirstLevelProperties(
            $person->getRace(),
            $person->getGender(),
            $person->getExceptionality()->getExceptionalityProperties(),
            $person->getProfessionLevels(),
            $tables
        );
        $this->nextLevelsProperties = new NextLevelsProperties($person->getProfessionLevels());

        $this->strength = Strength::getIt(
            $this->firstLevelProperties->getFirstLevelStrength()->getValue()
            + $this->nextLevelsProperties->getStrength()->getValue()
        );
        $this->agility = Agility::getIt(
            $this->firstLevelProperties->getFirstLevelAgility()->getValue()
            + $this->nextLevelsProperties->getAgility()->getValue()
        );
        $this->knack = Knack::getIt(
            $this->firstLevelProperties->getFirstLevelKnack()->getValue()
            + $this->nextLevelsProperties->getKnack()->getValue()
        );
        $this->will = Will::getIt(
            $this->firstLevelProperties->getFirstLevelWill()->getValue()
            + $this->nextLevelsProperties->getWill()->getValue()
        );
        $this->intelligence = Intelligence::getIt(
            $this->firstLevelProperties->getFirstLevelIntelligence()->getValue()
            + $this->nextLevelsProperties->getIntelligence()->getValue()
        );
        $this->charisma = Charisma::getIt(
            $this->firstLevelProperties->getFirstLevelCharisma()->getValue()
            + $this->nextLevelsProperties->getCharisma()->getValue()
        );
        $this->weightInKg = WeightInKg::getIt(
            $this->firstLevelProperties->getFirstLevelWeightInKg()->getValue()
            + $this->nextLevelsProperties->getWeightInKg()->getValue()
        );

        // delivered properties
        $this->toughness = new Toughness($this->getStrength()->getValue() + $person->getRace()->getToughnessModifier());
        $this->endurance = new Endurance((int)round($this->getStrength()->getValue() + $this->getWill()->getValue()));
        $this->size = $this->firstLevelProperties->getFirstLevelSize(); // there is no more size increment than the first level one
        $this->speed = new Speed($this->calculateSpeed($this->getStrength(), $this->getAgility(), $this->getSize()));
        $this->senses = new Senses($this->getKnack()->getValue() + $person->getRace()->getSensesModifier($person->getGender()));

        $this->fight = new Fight($person);
        $this->attack = new Attack($this->getAgility());
        $this->defense = new Defense($this->getAgility());
        $this->shooting = new Shooting($this->getKnack());
    }

    private function calculateSpeed(Strength $strength, Agility $agility, Size $size)
    {
        return intval(round(($strength->getValue() + $agility->getValue()) / 2) + $this->getSpeedBonusBySize($size));
    }

    private function getSpeedBonusBySize(Size $size)
    {
        if ($size->getValue() > 0) {
            return ceil($size->getValue() / 3) - 2; // 1 - 3 = -1; 4 - 6 = 0; 7 - 9 = +1 ...
        }

        return floor(($size->getValue() - 1) / 3) - 1; // -2 - 0 = -2 ...
    }

    /**
     * @return Strength
     */
    public function getStrength()
    {
        return $this->strength;
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
     * @return WeightInKg
     */
    public function getWeightInKg()
    {
        return $this->weightInKg;
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
        return $this->size;
    }

    /**
     * @return Senses
     */
    public function getSenses()
    {
        return $this->senses;
    }

    /**
     * @return Attack
     */
    public function getAttack()
    {
        return $this->attack;
    }

    /**
     * @return Defense
     */
    public function getDefense()
    {
        return $this->defense;
    }

    /**
     * @return Fight
     */
    public function getFight()
    {
        return $this->fight;
    }

    /**
     * @return Shooting
     */
    public function getShooting()
    {
        return $this->shooting;
    }

}
