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
     * @var Strength
     *
     * @ORM\Column(type="strength")
     */
    private $initialStrength;

    /**
     * @var Agility
     *
     * @ORM\Column(type="agility")
     */
    private $initialAgility;

    /**
     * @var Knack
     *
     * @ORM\Column(type="knack")
     */
    private $initialKnack;

    /**
     * @var Will
     *
     * @ORM\Column(type="will")
     */
    private $initialWill;

    /**
     * @var Intelligence
     *
     * @ORM\Column(type="intelligence")
     */
    private $initialIntelligence;

    /**
     * @var Charisma
     *
     * @ORM\Column(type="charisma")
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
        if ($this->person && $this->person->getId() !== $person->getId()) {
            throw new Exceptions\PersonIsAlreadySet('Initial properties of ID ' . $this->id . ' is linked with person of ID ' . $this->person->getId());
        }
        $this->person = $person;
    }

    /**
     * @return Strength
     */
    public function getInitialStrength()
    {
        return $this->initialStrength;
    }

    /**
     * @param Strength $initialStrength
     * @throws Exceptions\InitialPropertyValueExceeded
     * @return $this
     */
    public function setInitialStrength(Strength $initialStrength)
    {
        $this->setUpProperty(Strength::PROPERTY_CODE, $initialStrength);
        return $this;
    }

    /**
     * @param $personPropertyName "like strength"
     * @param Property $initialValue
     * @throws Exceptions\InitialPropertyIsAlreadySet
     * @throws Exceptions\InitialPropertyValueExceeded
     */
    private function setUpProperty($personPropertyName, Property $initialValue)
    {
        // like initialStrength()
        $classPropertyName = 'initial' . ucfirst($personPropertyName);
        if (isset($this->$classPropertyName)) {
            throw new Exceptions\InitialPropertyIsAlreadySet('The property ' . $classPropertyName . ' is already set');
        }
        // like calculateMaximalInitialStrength()
        $initialCalculationMethod = 'calculateMaximalInitial' . ucfirst($personPropertyName);
        if ($initialValue->getValue() > $this->$initialCalculationMethod()) {
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
     * @return Agility
     */
    public function getInitialAgility()
    {
        return $this->initialAgility;
    }

    /**
     * @param Agility $initialAgility
     * @throws Exceptions\InitialPropertyValueExceeded
     * @return $this
     */
    public function setInitialAgility(Agility $initialAgility)
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
     * @return Knack
     */
    public function getInitialKnack()
    {
        return $this->initialKnack;
    }

    /**
     * @param Knack $initialKnack
     * @throws Exceptions\InitialPropertyValueExceeded
     * @return $this
     */
    public function setInitialKnack(Knack $initialKnack)
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
     * @return Will
     */
    public function getInitialWill()
    {
        return $this->initialWill;
    }

    /**
     * @param Will $initialWill
     * @throws Exceptions\InitialPropertyValueExceeded
     * @return $this
     */
    public function setInitialWill(Will $initialWill)
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
     * @return Intelligence
     */
    public function getInitialIntelligence()
    {
        return $this->initialIntelligence;
    }

    /**
     * @param Intelligence $initialIntelligence
     * @throws Exceptions\InitialPropertyValueExceeded
     * @return $this
     */
    public function setInitialIntelligence(Intelligence $initialIntelligence)
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
     * @return Charisma
     */
    public function getInitialCharisma()
    {
        return $this->initialCharisma;
    }

    /**
     * @param Charisma $initialCharisma
     * @throws Exceptions\InitialPropertyValueExceeded
     * @return $this
     */
    public function setInitialCharisma(Charisma $initialCharisma)
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
