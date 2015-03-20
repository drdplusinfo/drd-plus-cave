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
     *
     * @throws Exceptions\PersonIsAlreadySet
     */
    public function setPerson(Person $person)
    {
        if (!$this->person) {
            $this->person = $person;
        } elseif ($this->person !== $person) {
            throw new Exceptions\PersonIsAlreadySet(
                'Initial properties entity of ID ' . var_export($this->id, true)
                . ' is linked with person of ID ' . var_export($this->person->getId(), true) . '.'
                . ' Added person of ID (or different instance) ' . var_export($person->getId(), true) . '.'
            );
        }
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
     *
     * @throws Exceptions\InitialPropertyValueExceeded
     * @return $this
     */
    public function setInitialStrength(Strength $initialStrength)
    {
        $this->setUpProperty($initialStrength);

        return $this;
    }

    /**
     * @param Property $initialValue
     *
     * @throws Exceptions\InitialPropertyIsAlreadySet
     * @throws Exceptions\InitialPropertyValueExceeded
     */
    private function setUpProperty(Property $initialValue)
    {
        $propertyName = $initialValue->getTypeName();
        // like initialStrength()
        $initialPropertyName = 'initial' . ucfirst($propertyName);
        if (isset($this->$initialPropertyName)) {
            throw new Exceptions\InitialPropertyIsAlreadySet(
                'The property ' . $initialPropertyName . ' is already set by value ' . var_export($this->$initialPropertyName->getValue(), true)
            );
        }

        // like calculateMaximalInitialStrength()
        $initialCalculationMethod = 'calculateMaximalInitial' . ucfirst($propertyName);
        if ($initialValue->getValue() > $this->$initialCalculationMethod()) {
            throw new Exceptions\InitialPropertyValueExceeded('The initial ' . $propertyName . ' can not exceed ' . $this->$initialCalculationMethod());
        }

        $this->$initialPropertyName = $initialValue;
    }

    /**
     * @return int
     */
    public function calculateMaximalInitialStrength()
    {
        return $this->calculateMaximalInitialProperty(Strength::TYPE_STRENGTH);
    }

    /**
     * @param string $propertyName
     *
     * @return int
     */
    private function calculateMaximalInitialProperty($propertyName)
    {
        if (!$this->getPerson()) {
            throw new Exceptions\PersonIsNotSet(
                'To calculate initial properties a person is required'
            );
        }

        // like getStrengthModifier()
        $propertyModifierGetter = 'get' . ucfirst($propertyName) . 'Modifier';

        return
            self::INITIAL_PROPERTY_INCREASE_LIMIT
            + $this->getPerson()->getRace()->$propertyModifierGetter(
                $this->getPerson()->getGender()
            );
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
     *
     * @throws Exceptions\InitialPropertyValueExceeded
     * @return $this
     */
    public function setInitialAgility(Agility $initialAgility)
    {
        $this->setUpProperty($initialAgility);

        return $this;
    }

    /**
     * @return int
     */
    public function calculateMaximalInitialAgility()
    {
        return $this->calculateMaximalInitialProperty(Agility::TYPE_AGILITY);
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
     *
     * @throws Exceptions\InitialPropertyValueExceeded
     * @return $this
     */
    public function setInitialKnack(Knack $initialKnack)
    {
        $this->setUpProperty($initialKnack);

        return $this;
    }

    /**
     * @return int
     */
    public function calculateMaximalInitialKnack()
    {
        return $this->calculateMaximalInitialProperty(Knack::TYPE_KNACK);
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
     *
     * @throws Exceptions\InitialPropertyValueExceeded
     * @return $this
     */
    public function setInitialWill(Will $initialWill)
    {
        $this->setUpProperty($initialWill);

        return $this;
    }

    /**
     * @return int
     */
    public function calculateMaximalInitialWill()
    {
        return $this->calculateMaximalInitialProperty(Will::TYPE_WILL);
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
     *
     * @throws Exceptions\InitialPropertyValueExceeded
     * @return $this
     */
    public function setInitialIntelligence(Intelligence $initialIntelligence)
    {
        $this->setUpProperty($initialIntelligence);

        return $this;
    }

    /**
     * @return int
     */
    public function calculateMaximalInitialIntelligence()
    {
        return $this->calculateMaximalInitialProperty(Intelligence::TYPE_INTELLIGENCE);
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
     *
     * @throws Exceptions\InitialPropertyValueExceeded
     * @return $this
     */
    public function setInitialCharisma(Charisma $initialCharisma)
    {
        $this->setUpProperty($initialCharisma);

        return $this;
    }

    /**
     * @return int
     */
    public function calculateMaximalInitialCharisma()
    {
        return $this->calculateMaximalInitialProperty(Charisma::TYPE_CHARISMA);
    }
}
