<?php

namespace DrdPlus\Cave\UnitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Level;
use DrdPlus\Cave\UnitBundle\Enum\Races\Race;

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
     * @return int
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

        return $this;
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
