<?php

namespace DrdPlus\Cave\UnitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Level;
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
     * @var array
     *
     * @ORM\Column(name="raceAndGenderCodes", type="simple_array")
     */
    private $raceAndGenderCodes;

    /**
     * @var Race
     */
    private $race;

    /**
     * @var Level[]
     *
     * @ORM\OneToMany(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Level", mappedBy="level")
     */
    private $levels;

    public function __construct()
    {
        $this->raceAndGenderCodes = ['raceCode' => null, 'genderCode' => null];
    }

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
     * @param string $raceCode
     */
    public function setRaceCode($raceCode)
    {
        $this->raceAndGenderCodes['raceCode'] = $raceCode;
    }

    /**
     * @param string $genderCode
     */
    public function setGenderCode($genderCode)
    {
        $this->raceAndGenderCodes['genderCode'] = $genderCode;
    }

    /**
     * Set race and gender codes
     *
     * @param string $raceAndGenderCodes
     * @return Person
     */
    public function setRaceAndGenderCodes($raceAndGenderCodes)
    {
        $this->raceAndGenderCodes = $raceAndGenderCodes;
        $this->race = $this->createRace($raceAndGenderCodes['raceCode'], $raceAndGenderCodes['genderCode']);

        return $this;
    }

    /**
     * @param string $raceCode
     * @param string $genderCode
     * @return Race
     */
    private function createRace($raceCode, $genderCode)
    {
        switch ($raceCode) {
            case Orc::CODE :
                return new Orc($genderCode);
            case DarkElf::CODE :
                return new DarkElf($genderCode);
            case Dwarf::CODE :
                return new Dwarf($genderCode);
            case Elf::CODE :
                return new Elf($genderCode);
            case Goblin::CODE :
                return new Goblin($genderCode);
            case GreenElf::CODE :
                return new GreenElf($genderCode);
            case Highlander::CODE :
                return new Highlander($genderCode);
            case Hobbit::CODE :
                return new Hobbit($genderCode);
            case Human::CODE :
                return new Human($genderCode);
            case Kroll::CODE :
                return new Kroll($genderCode);
            case MountainDwarf::CODE :
                return new MountainDwarf($genderCode);
            case Skurut::CODE :
                return new Skurut($genderCode);
            case WildKroll::CODE :
                return new WildKroll($genderCode);
            case WoodDwarf::CODE :
                return new WoodDwarf($genderCode);
            default :
                throw new \RuntimeException('Unknown race code ' . var_export($raceCode, true));
        }
    }

    /**
     * Get race and gender codes
     *
     * @return array
     */
    public function getRaceAndGenderCodes()
    {
        return $this->raceAndGenderCodes;
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
     * Set levels
     *
     * @param Level[] $levels
     * @return $this
     */
    public function setLevels(array $levels)
    {
        $this->levels = $levels;

        return $this;
    }

    /**
     * Get levels
     *
     * @return Level[]
     */
    public function getLevels()
    {
        return $this->levels;
    }

}
