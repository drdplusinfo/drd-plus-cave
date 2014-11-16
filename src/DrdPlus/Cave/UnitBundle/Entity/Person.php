<?php

namespace DrdPlus\Cave\UnitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Gender;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Professions\Fighter;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Professions\Priest;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Professions\Ranger;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Professions\Theurgist;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Professions\Thief;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Professions\Wizard;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Property;
use DrdPlus\Cave\UnitBundle\Enum\Races\DarkElf;
use DrdPlus\Cave\UnitBundle\Enum\Races\Dwarf;
use DrdPlus\Cave\UnitBundle\Enum\Races\Elf;
use DrdPlus\Cave\UnitBundle\Enum\Races\Goblin;
use DrdPlus\Cave\UnitBundle\Enum\Races\GreenElf;
use DrdPlus\Cave\UnitBundle\Enum\Races\Highlander;
use DrdPlus\Cave\UnitBundle\Enum\Races\Hobbit;
use DrdPlus\Cave\UnitBundle\Enum\Races\Human;
use DrdPlus\Cave\UnitBundle\Enum\Races\Kroll;
use DrdPlus\Cave\UnitBundle\Enum\Races\MountainDwarf;
use DrdPlus\Cave\UnitBundle\Enum\Races\Orc;
use DrdPlus\Cave\UnitBundle\Enum\Races\Race;
use DrdPlus\Cave\UnitBundle\Enum\Races\Skurut;
use DrdPlus\Cave\UnitBundle\Enum\Races\WildKroll;
use DrdPlus\Cave\UnitBundle\Enum\Races\WoodDwarf;

/**
 * Person
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Person
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var Race
     */
    private $race;

    /**
     * @var string
     *
     * @ORM\Column(name="raceCode", type="string", length=255)
     */
    private $raceCode;

    /**
     * @var Fighter
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Professions\Fighter")
     */
    private $fighter;
    /**
     * @var Priest
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Professions\Priest")
     */
    private $priest;
    /**
     * @var Ranger
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Professions\Ranger")
     */
    private $ranger;
    /**
     * @var Theurgist
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Professions\Theurgist")
     */
    private $theurgist;
    /**
     * @var Thief
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Professions\Thief")
     */
    private $thief;
    /**
     * @var Wizard
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Professions\Wizard")
     */
    private $wizard;

    /**
     * @var Gender
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Gender")
     */
    private $gender;

    /**
     * @var Property
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Property")
     */
    private $strength;

    /**
     * @var Property
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Property")
     */
    private $agility;

    /**
     * @var Property
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Property")
     */
    private $knack;

    /**
     * @var Property
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Property")
     */
    private $will;

    /**
     * @var Property
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Property")
     */
    private $intelligence;

    /**
     * @var Property
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Property")
     */
    private $charisma;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Person
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set race code
     *
     * @param string $raceCode
     * @return Person
     */
    public function setRaceCode($raceCode)
    {
        $this->raceCode = $raceCode;
        $this->race = $this->createRace($raceCode);

        return $this;
    }

    /**
     * @param $raceCode
     * @return Race
     */
    private function createRace($raceCode)
    {
        switch ($raceCode) {
            case Orc::CODE :
                return new Orc();
            case DarkElf::CODE :
                return new DarkElf();
            case Dwarf::CODE :
                return new Dwarf();
            case Elf::CODE :
                return new ELf();
            case Goblin::CODE :
                return new Goblin();
            case GreenElf::CODE :
                return new GreenElf();
            case Highlander::CODE :
                return new Highlander();
            case Hobbit::CODE :
                return new Hobbit();
            case Human::CODE :
                return new Human();
            case Kroll::CODE :
                return new Kroll();
            case MountainDwarf::CODE :
                return new MountainDwarf();
            case Skurut::CODE :
                return new Skurut();
            case WildKroll::CODE :
                return new WildKroll();
            case WoodDwarf::CODE :
                return new WoodDwarf();
            default :
                throw new \RuntimeException('Unknown race code ' . var_export($raceCode, true));
        }
    }

    /**
     * Get race
     *
     * @return Race
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * Set fighter
     *
     * @param Fighter $fighter
     * @return Person
     */
    public function setFighter(Fighter $fighter)
    {
        $this->fighter = $fighter;

        return $this;
    }

    /**
     * Get fighter
     *
     * @return Fighter|null
     */
    public function getFighter()
    {
        return $this->fighter;
    }

    /**
     * Set priest
     *
     * @param Priest $priest
     * @return Person
     */
    public function setPriest(Priest $priest)
    {
        $this->priest = $priest;

        return $this;
    }

    /**
     * Get priest
     *
     * @return Priest|null
     */
    public function getPriest()
    {
        return $this->priest;
    }

    /**
     * Set ranger
     *
     * @param Ranger $ranger
     * @return Person
     */
    public function setRanger(Ranger $ranger)
    {
        $this->ranger = $ranger;

        return $this;
    }

    /**
     * Get ranger
     *
     * @return Ranger|null
     */
    public function getRanger()
    {
        return $this->ranger;
    }

    /**
     * Set theurgist
     *
     * @param Theurgist $theurgist
     * @return Person
     */
    public function setTheurgist(Theurgist $theurgist)
    {
        $this->theurgist = $theurgist;

        return $this;
    }

    /**
     * Get theurgist
     *
     * @return Theurgist|null
     */
    public function getTheurgist()
    {
        return $this->theurgist;
    }

    /**
     * Set thief
     *
     * @param Thief $thief
     * @return Person
     */
    public function setThief(Thief $thief)
    {
        $this->thief = $thief;

        return $this;
    }

    /**
     * Get thief
     *
     * @return Thief|null
     */
    public function getThief()
    {
        return $this->thief;
    }

    /**
     * Set wizard
     *
     * @param Wizard $wizard
     * @return Person
     */
    public function setWizard($wizard)
    {
        $this->wizard = $wizard;

        return $this;
    }

    /**
     * Get wizard
     *
     * @return Wizard|null
     */
    public function getWizard()
    {
        return $this->wizard;
    }

    /**
     * Set gender
     *
     * @param Gender $gender
     * @return Person
     */
    public function setGender(Gender $gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set strength
     *
     * @param Property $strength
     * @return Person
     */
    public function setStrength(Property $strength)
    {
        $this->strength = $strength;

        return $this;
    }

    /**
     * Get strength
     *
     * @return Property
     */
    public function getStrength()
    {
        return $this->strength;
    }

    /**
     * @param Property $agility
     */
    public function setAgility(Property $agility)
    {
        $agility->setName(Property::AGILITY_NAME);
        $agility->setShortName(Property::AGILITY_SHORT_NAME);
        $this->agility = $agility;
    }

    /**
     * @return Property
     */
    public function getAgility()
    {
        return $this->agility;
    }

    /**
     * @param Property $charisma
     */
    public function setCharisma(Property $charisma)
    {
        $charisma->setName(Property::CHARISMA_NAME);
        $charisma->setShortName(Property::CHARISMA_SHORT_NAME);
        $this->charisma = $charisma;
    }

    /**
     * @return Property
     */
    public function getCharisma()
    {
        return $this->charisma;
    }

    /**
     * @param Property $intelligence
     */
    public function setIntelligence(Property $intelligence)
    {
        $intelligence->setName(Property::INTELLIGENCE_NAME);
        $intelligence->setShortName(Property::INTELLIGENCE_SHORT_NAME);
        $this->intelligence = $intelligence;
    }

    /**
     * @return Property
     */
    public function getIntelligence()
    {
        return $this->intelligence;
    }

    /**
     * @param Property $knack
     */
    public function setKnack(Property $knack)
    {
        $knack->setName(Property::KNACK_NAME);
        $knack->setShortName(Property::KNACK_SHORT_NAME);
        $this->knack = $knack;
    }

    /**
     * @return Property
     */
    public function getKnack()
    {
        return $this->knack;
    }

    /**
     * @param Property $will
     */
    public function setWill(Property $will)
    {
        $will->setName(Property::WILL_NAME);
        $will->setShortName(Property::WILL_SHORT_NAME);
        $this->will = $will;
    }

    /**
     * @return Property
     */
    public function getWill()
    {
        return $this->will;
    }

}
