<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Entity\Person;

/**
 * InitialProperties
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class InitialProperties
{
    const INITIAL_PROPERTY_INCREASE_LIMIT = 3;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Person
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Person")
     */
    private $person;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $initialStrength;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $initialAgility;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $initialKnack;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $initialWill;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $initialIntelligence;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $initialCharisma;

    /**
     * @return Person
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * @param Person $person
     */
    public function setPerson($person)
    {
        $this->person = $person;
    }

    /**
     * @return int
     */
    public function getInitialStrength()
    {
        return $this->initialStrength;
    }

    /**
     * @param int $initialStrength
     * @throws Exceptions\InitialPropertyValueExceeded
     */
    public function setInitialStrength($initialStrength)
    {
        if ($initialStrength > $this->calculateMaximalInitialStrength()) {
            throw new Exceptions\InitialPropertyValueExceeded('The initial strength can not exceed ' . $this->calculateMaximalInitialStrength());
        }
        $this->initialStrength = $initialStrength;
    }

    /**
     * @return int
     */
    public function calculateMaximalInitialStrength()
    {
        return self::INITIAL_PROPERTY_INCREASE_LIMIT + $this->getPerson()->getRace()->getStrengthModifier($this->getPerson()->getGender());
    }

    /**
     * @return int
     */
    public function getInitialAgility()
    {
        return $this->initialAgility;
    }

    /**
     * @param int $initialAgility
     * @throws Exceptions\InitialPropertyValueExceeded
     */
    public function setInitialAgility($initialAgility)
    {
        if ($initialAgility > $this->calculateMaximalInitialStrength()) {
            throw new Exceptions\InitialPropertyValueExceeded('The initial agility can not exceed ' . $this->calculateMaximalInitialAgility());
        }
        $this->initialAgility = $initialAgility;
    }

    /**
     * @return int
     */
    public function calculateMaximalInitialAgility()
    {
        return self::INITIAL_PROPERTY_INCREASE_LIMIT + $this->getPerson()->getRace()->getAgilityModifier($this->getPerson()->getGender());
    }

    /**
     * @return int
     */
    public function getInitialKnack()
    {
        return $this->initialKnack;
    }

    /**
     * @param int $initialKnack
     * @throws Exceptions\InitialPropertyValueExceeded
     */
    public function setInitialKnack($initialKnack)
    {
        if ($initialKnack > $this->calculateMaximalInitialKnack()) {
            throw new Exceptions\InitialPropertyValueExceeded('The initial knack can not exceed ' . $this->calculateMaximalInitialKnack());
        }
        $this->initialKnack = $initialKnack;
    }

    /**
     * @return int
     */
    public function calculateMaximalInitialKnack()
    {
        return self::INITIAL_PROPERTY_INCREASE_LIMIT + $this->getPerson()->getRace()->getKnackModifier($this->getPerson()->getGender());
    }

    /**
     * @return int
     */
    public function getInitialWill()
    {
        return $this->initialWill;
    }

    /**
     * @param int $initialWill
     * @throws Exceptions\InitialPropertyValueExceeded
     */
    public function setInitialWill($initialWill)
    {
        if ($initialWill > $this->calculateMaximalInitialWill()) {
            throw new Exceptions\InitialPropertyValueExceeded('The initial will can not exceed ' . $this->calculateMaximalInitialWill());
        }
        $this->initialWill = $initialWill;
    }

    /**
     * @return int
     */
    public function calculateMaximalInitialWill()
    {
        return self::INITIAL_PROPERTY_INCREASE_LIMIT + $this->getPerson()->getRace()->getWillModifier($this->getPerson()->getGender());
    }

    /**
     * @return int
     */
    public function getInitialIntelligence()
    {
        return $this->initialIntelligence;
    }

    /**
     * @param int $initialIntelligence
     * @throws Exceptions\InitialPropertyValueExceeded
     */
    public function setInitialIntelligence($initialIntelligence)
    {
        if ($initialIntelligence > $this->calculateMaximalInitialIntelligence()) {
            throw new Exceptions\InitialPropertyValueExceeded('The initial intelligence can not exceed ' . $this->calculateMaximalInitialIntelligence());
        }
        $this->initialIntelligence = $initialIntelligence;
    }

    /**
     * @return int
     */
    public function calculateMaximalInitialIntelligence()
    {
        return self::INITIAL_PROPERTY_INCREASE_LIMIT + $this->getPerson()->getRace()->getIntelligenceModifier($this->getPerson()->getGender());
    }

    /**
     * @return int
     */
    public function getInitialCharisma()
    {
        return $this->initialCharisma;
    }

    /**
     * @param int $initialCharisma
     * @throws Exceptions\InitialPropertyValueExceeded
     */
    public function setInitialCharisma($initialCharisma)
    {
        if ($initialCharisma > $this->calculateMaximalInitialCharisma()) {
            throw new Exceptions\InitialPropertyValueExceeded('The initial charisma can not exceed ' . $this->calculateMaximalInitialCharisma());
        }
        $this->initialCharisma = $initialCharisma;
    }

    /**
     * @return int
     */
    public function calculateMaximalInitialCharisma()
    {
        return self::INITIAL_PROPERTY_INCREASE_LIMIT + $this->getPerson()->getRace()->getCharismaModifier($this->getPerson()->getGender());
    }
}
