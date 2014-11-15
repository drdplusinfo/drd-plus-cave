<?php

namespace DrdPlus\Cave\UnitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Gender;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Professions\Profession;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Property;
use DrdPlus\Cave\UnitBundle\Enum\Races\Race;

/**
 * Person
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DrdPlus\Cave\UnitBundle\Entity\PersonRepository")
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
     *
     * @OneToOne(targetEntity="Race")
     */
    private $race;

    /**
     * @var Profession
     *
     * @OneToOne(targetEntity="Profession")
     */
    private $profession;

    /**
     * @var Gender
     *
     * @OneToOne(targetEntity="Gender")
     */
    private $gender;

    /**
     * @var Property
     *
     * @OneToOne(targetEntity="Property")
     */
    private $strength;

    /**
     * @var Property
     *
     * @OneToOne(targetEntity="Property")
     */
    private $agility;

    /**
     * @var Property
     *
     * @OneToOne(targetEntity="Property")
     */
    private $knack;

    /**
     * @var Property
     *
     * @OneToOne(targetEntity="Property")
     */
    private $will;

    /**
     * @var Property
     *
     * @OneToOne(targetEntity="Property")
     */
    private $intelligence;

    /**
     * @var Property
     *
     * @OneToOne(targetEntity="Property")
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
     * Set race
     *
     * @param Race $race
     * @return Person
     */
    public function setRace(Race $race)
    {
        $this->race = $race;

        return $this;
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
     * Set profession
     *
     * @param string $profession
     * @return Person
     */
    public function setProfession($profession)
    {
        $this->profession = $profession;

        return $this;
    }

    /**
     * Get profession
     *
     * @return string
     */
    public function getProfession()
    {
        return $this->profession;
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
