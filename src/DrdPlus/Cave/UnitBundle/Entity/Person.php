<?php

namespace DrdPlus\Cave\UnitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Level;
use DrdPlus\Cave\UnitBundle\Enum\Races\Gender;
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
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var array
     *
     * @ORM\Column(type="gender")
     */
    private $gender;

    /**
     * @var Race
     *
     * @ORM\Column(type="race")
     */
    private $race;

    /**
     * @var Level[]
     *
     * @ORM\OneToMany(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Level", mappedBy="person")
     */
    private $levels;

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
     * @param Race $race
     */
    public function setRace(Race $race)
    {
        $this->race = $race;
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
     * @param Gender $gender
     */
    public function setGender(Gender $gender)
    {
        $this->gender = $gender;
    }

    /**
     * Get gender
     *
     * @return Gender
     */
    public function getGender()
    {
        return $this->gender;
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
