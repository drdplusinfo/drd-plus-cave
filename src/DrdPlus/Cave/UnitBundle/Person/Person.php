<?php
namespace DrdPlus\Cave\UnitBundle\Person;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Exceptionality;
use DrdPlus\Cave\UnitBundle\Person\Attributes\GameCharacteristics\Combat\Attack;
use DrdPlus\Cave\UnitBundle\Person\Attributes\GameCharacteristics\Combat\Defense;
use DrdPlus\Cave\UnitBundle\Person\Attributes\GameCharacteristics\Combat\Fight;
use DrdPlus\Cave\UnitBundle\Person\Attributes\GameCharacteristics\Combat\Shooting;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Name;
use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\ProfessionLevels;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\PersonProperties;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Derived\Toughness;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Gender;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Race;
use Granam\Strict\Object\StrictObject;

/**
 * Person
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Person extends StrictObject
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Name
     *
     * @ORM\Column(type="name")
     */
    private $name;

    /**
     * @var Race
     *
     * @ORM\Column(type="race")
     */
    private $race;

    /**
     * @var Gender
     *
     * @ORM\Column(type="gender")
     */
    private $gender;

    /**
     * @var PersonProperties
     *
     * @ORM\Column(type="exceptionality")
     */
    private $exceptionality;

    /**
     * @var PersonProperties
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\BaseProperties")
     */
    private $baseProperties;

    /**
     * @var ProfessionLevels
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\ProfessionLevels")
     */
    private $professionLevels;

    /** @var Toughness */
    private $toughness;

    /** @var Fight */
    private $fight;

    /** @var Attack */
    private $attack;

    /** @var Defense */
    private $defense;

    /** @var Shooting */
    private $shooting;

    public function __construct(
        Race $race, // enum
        Gender $gender, // enum
        Name $name, // enum
        Exceptionality $exceptionality, // entity
        ProfessionLevels $professionLevels // entity
    )
    {
        $this->race = $race;
        $this->gender = $gender;
        $this->name = $name;
        $exceptionality->setPerson($this);
        $this->exceptionality = $exceptionality;
        $professionLevels->setPerson($this);
        $this->professionLevels = $professionLevels;

        // helpers - every value is recalculated on each request
        $this->baseProperties = new PersonProperties($this);
        $this->fight = new Fight($this);
        $this->attack = new Attack($this->getCurrentAgility());
        $this->defense = new Defense($this->getCurrentAgility());
        $this->shooting = new Shooting($this->getCurrentKnack());
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Name is an enum, therefore de facto a constant, therefore only way how to change the name is to replace it
     *
     * @param Name $name
     *
     * @return $this
     */
    public function setName(Name $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Race
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * @return Gender
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @return PersonProperties
     */
    public function getBaseProperties()
    {
        return $this->baseProperties;
    }

    /**
     * @return Exceptionality
     */
    public function getExceptionality()
    {
        return $this->exceptionality;
    }

    /**
     * @return ProfessionLevels
     */
    public function getProfessionLevels()
    {
        return $this->professionLevels;
    }

    /**
     * @return Toughness
     */
    public function getToughness()
    {
        if (!isset($this->toughness)) {
            $this->toughness = Toughness::getIt($this->calculateCurrentToughness());
        }

        return $this->toughness;
    }

    /**
     * @return int
     */
    private function calculateCurrentToughness()
    {
        return $this->getCurrentStrength()->getValue()
        + $this->getRace()->getToughnessModifier();
    }

    /**
     * @return Strength
     */
    public function getCurrentStrength()
    {
        return Strength::getIt($this->calculateCurrentProperty(Strength::STRENGTH));
    }

    /**
     * @param $propertyName
     *
     * @return int
     */
    private function calculateCurrentProperty($propertyName)
    {
        $getProperty = 'get' . ucfirst($propertyName);
        $getPropertyModifier = 'get' . ucfirst($propertyName) . 'Modifier';
        $getPropertyIncrementSummary = 'get' . ucfirst($propertyName) . 'IncrementSummary';

        return
            $this->getBaseProperties()->$getProperty()->getValue()
            + $this->getRace()->$getPropertyModifier($this->getGender())
            + $this->getExceptionality()->getExceptionalityProperties()->$getProperty()->getValue()
            // TODO check if first level is NOT counted
            + $this->getProfessionLevels()->$getPropertyIncrementSummary();
    }

    /**
     * @return Agility
     */
    public function getCurrentAgility()
    {
        return Agility::getIt($this->calculateCurrentProperty(Agility::AGILITY));
    }

    /**
     * @return Knack
     */
    public function getCurrentKnack()
    {
        return Knack::getIt($this->calculateCurrentProperty(Knack::KNACK));
    }

    /**
     * @return Intelligence
     */
    public function getCurrentIntelligence()
    {
        return Intelligence::getIt($this->calculateCurrentProperty(Intelligence::INTELLIGENCE));
    }

    /**
     * @return Charisma
     */
    public function getCurrentCharisma()
    {
        return Charisma::getIt($this->calculateCurrentProperty(Charisma::CHARISMA));
    }

    /**
     * @return Attributes\Properties\Body\Size
     */
    public function getSize()
    {
        // there is no other size modifier then the base size
        return $this->getBaseProperties()->getSize();
    }

    /**
     * @return Fight
     */
    public function getFight()
    {
        return $this->fight;
    }

    /**
     * @return Defense
     */
    public function getDefense()
    {
        return $this->defense;
    }

    /**
     * @return Shooting
     */
    public function getShooting()
    {
        return $this->shooting;
    }

    /**
     * @return Attack
     */
    public function getAttack()
    {
        return $this->attack;
    }

}
