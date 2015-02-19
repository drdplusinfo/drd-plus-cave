<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Entity\Person;
use Granam\Strict\Object\StrictObject;

/**
 * InitialProperties
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class InitialProperties extends StrictObject
{
    const INITIAL_PROPERTY_INCREASE_LIMIT = 3;

    /**
     * Value object, the ID is just for Doctrine linking
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
     * @throws Exceptions\PersonIsAlreadySet
     */
    public function setPerson(Person $person)
    {
        if ($this->person) {
            throw new Exceptions\PersonIsAlreadySet('Initial properties of ID ' . $this->id . ' is linked with person of ID ' . $this->person->getId());
        }
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
     * @return $this
     */
    public function setInitialStrength($initialStrength)
    {
        $this->setUpProperty(Strength::PROPERTY_CODE, $initialStrength);
        return $this;
    }

    /**
     * @param $personPropertyName
     * @param $initialValue
     * @throws Exceptions\InitialPropertyIsAlreadySet
     * @throws Exceptions\InitialPropertyValueExceeded
     */
    private function setUpProperty($personPropertyName, $initialValue)
    {
        $classPropertyName = 'initial' . ucfirst($personPropertyName);
        if (isset($this->$classPropertyName)) {
            throw new Exceptions\InitialPropertyIsAlreadySet('The property ' . $classPropertyName . ' is already set');
        }
        // like calculateMaximalInitialStrength()
        $initialCalculationMethod = 'calculateMaximalInitial' . ucfirst($personPropertyName);
        if ($initialValue > $this->$initialCalculationMethod()) {
            throw new Exceptions\InitialPropertyValueExceeded('The initial ' . $personPropertyName . ' can not exceed ' . $this->$initialCalculationMethod());
        }

        $this->$classPropertyName = $initialValue;
    }

    /**
     * @return int
     */
    public function calculateMaximalInitialStrength()
    {
        return $this->calculateMaximalInitialProperty(Strength::PROPERTY_CODE);
    }

    /**
     * @param string $propertyName
     * @return int
     */
    private function calculateMaximalInitialProperty($propertyName)
    {
        // like getStrengthModifier()
        $propertyModifierGetter = 'get' . ucfirst($propertyName) . 'Modifier';
        return self::INITIAL_PROPERTY_INCREASE_LIMIT + $this->getPerson()->getRace()->$propertyModifierGetter($this->getPerson()->getGender());
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
     * @return $this
     */
    public function setInitialAgility($initialAgility)
    {
        $this->setUpProperty(Agility::PROPERTY_CODE, $initialAgility);
        return $this;
    }

    /**
     * @return int
     */
    public function calculateMaximalInitialAgility()
    {
        return $this->calculateMaximalInitialProperty(Agility::PROPERTY_CODE);
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
     * @return $this
     */
    public function setInitialKnack($initialKnack)
    {
        $this->setUpProperty(Knack::PROPERTY_CODE, $initialKnack);
        return $this;
    }

    /**
     * @return int
     */
    public function calculateMaximalInitialKnack()
    {
        return $this->calculateMaximalInitialProperty(Knack::PROPERTY_CODE);
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
     * @return $this
     */
    public function setInitialWill($initialWill)
    {
        $this->setUpProperty(Will::PROPERTY_CODE, $initialWill);
        return $this;
    }

    /**
     * @return int
     */
    public function calculateMaximalInitialWill()
    {
        return $this->calculateMaximalInitialProperty(Will::PROPERTY_CODE);
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
     * @return $this
     */
    public function setInitialIntelligence($initialIntelligence)
    {
        $this->setUpProperty(Intelligence::PROPERTY_CODE, $initialIntelligence);
        return $this;
    }

    /**
     * @return int
     */
    public function calculateMaximalInitialIntelligence()
    {
        return $this->calculateMaximalInitialProperty(Intelligence::PROPERTY_CODE);
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
     * @return $this
     */
    public function setInitialCharisma($initialCharisma)
    {
        $this->setUpProperty(Charisma::PROPERTY_CODE, $initialCharisma);
        return $this;
    }

    /**
     * @return int
     */
    public function calculateMaximalInitialCharisma()
    {
        return $this->calculateMaximalInitialProperty(Charisma::PROPERTY_CODE);
    }
}
