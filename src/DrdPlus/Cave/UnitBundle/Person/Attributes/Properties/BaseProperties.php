<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Person\Person;
use Granam\Strict\Object\StrictObject;

/**
 * BaseProperties
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class BaseProperties extends StrictObject
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
    protected $id;

    /**
     * @var Person
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Person\Person")
     */
    private $person;

    /**
     * @var Strength
     *
     * @ORM\Column(type="strength")
     */
    private $baseStrength;

    /**
     * @var Agility
     *
     * @ORM\Column(type="agility")
     */
    private $baseAgility;

    /**
     * @var Knack
     *
     * @ORM\Column(type="knack")
     */
    private $baseKnack;

    /**
     * @var Will
     *
     * @ORM\Column(type="will")
     */
    private $baseWill;

    /**
     * @var Intelligence
     *
     * @ORM\Column(type="intelligence")
     */
    private $baseIntelligence;

    /**
     * @var Charisma
     *
     * @ORM\Column(type="charisma")
     */
    private $baseCharisma;

    /**
     * @return Person
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * @return string
     */
    public function getVoId()
    {
        return $this->getBaseStrength() . '-' . $this->getBaseAgility() . '-' . $this->getBaseKnack() . '-' . $this->getBaseWill()
        . '-' . $this->getBaseIntelligence() . '-' . $this->getBaseCharisma();
    }

    public function setPerson(Person $person)
    {
        if (is_null($this->getVoId()) && is_null($person->getBaseProperties()->getVoId())
            && $this !== $person->getBaseProperties()
        ) {
            throw new \LogicException;
        }

        if ($person->getBaseProperties()->getVoId() !== $this->getVoId()) {
            throw new Exceptions\PersonIsAlreadySet();
        }

        if (!$this->getPerson()) {
            $this->person = $person;
        } elseif ($person->getId() !== $this->getPerson()->getId()) {
            throw new \LogicException();
        }
    }

    /**
     * @return Strength
     */
    public function getBaseStrength()
    {
        return $this->baseStrength;
    }

    /**
     * @param Strength $baseStrength
     *
     * @throws Exceptions\BasePropertyValueExceeded
     * @return $this
     */
    public function setBaseStrength(Strength $baseStrength)
    {
        $this->setUpProperty($baseStrength);

        return $this;
    }

    /**
     * @param Property $baseValue
     *
     * @throws Exceptions\BasePropertyIsAlreadySet
     * @throws Exceptions\BasePropertyValueExceeded
     */
    private function setUpProperty(Property $baseValue)
    {
        $propertyName = $baseValue->getTypeName();
        // like baseStrength
        $basePropertyName = 'base' . ucfirst($propertyName);
        if (isset($this->$basePropertyName)) {
            throw new Exceptions\BasePropertyIsAlreadySet(
                'The property ' . $basePropertyName . ' is already set by value ' . var_export($this->$basePropertyName->getValue(), true)
            );
        }

        // like calculateMaximalBaseStrength()
        $baseCalculationMethod = 'calculateMaximalBase' . ucfirst($propertyName);
        if ($baseValue->getValue() > $this->$baseCalculationMethod()) {
            throw new Exceptions\BasePropertyValueExceeded('The base ' . $propertyName . ' can not exceed ' . $this->$baseCalculationMethod());
        }

        $this->$basePropertyName = $baseValue;
    }

    /**
     * @return int
     */
    public function calculateMaximalBaseStrength()
    {
        return $this->calculateMaximalBaseProperty(Strength::STRENGTH);
    }

    /**
     * @param string $propertyName
     *
     * @return int
     */
    private function calculateMaximalBaseProperty($propertyName)
    {
        if (!$this->getPerson()) {
            throw new Exceptions\PersonIsNotSet(
                'To calculate base properties a person is required'
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
    public function getBaseAgility()
    {
        return $this->baseAgility;
    }

    /**
     * @param Agility $baseAgility
     *
     * @throws Exceptions\BasePropertyValueExceeded
     * @return $this
     */
    public function setBaseAgility(Agility $baseAgility)
    {
        $this->setUpProperty($baseAgility);

        return $this;
    }

    /**
     * @return int
     */
    public function calculateMaximalBaseAgility()
    {
        return $this->calculateMaximalBaseProperty(Agility::AGILITY);
    }

    /**
     * @return Knack
     */
    public function getBaseKnack()
    {
        return $this->baseKnack;
    }

    /**
     * @param Knack $baseKnack
     *
     * @throws Exceptions\BasePropertyValueExceeded
     * @return $this
     */
    public function setBaseKnack(Knack $baseKnack)
    {
        $this->setUpProperty($baseKnack);

        return $this;
    }

    /**
     * @return int
     */
    public function calculateMaximalBaseKnack()
    {
        return $this->calculateMaximalBaseProperty(Knack::KNACK);
    }

    /**
     * @return Will
     */
    public function getBaseWill()
    {
        return $this->baseWill;
    }

    /**
     * @param Will $baseWill
     *
     * @throws Exceptions\BasePropertyValueExceeded
     * @return $this
     */
    public function setBaseWill(Will $baseWill)
    {
        $this->setUpProperty($baseWill);

        return $this;
    }

    /**
     * @return int
     */
    public function calculateMaximalBaseWill()
    {
        return $this->calculateMaximalBaseProperty(Will::WILL);
    }

    /**
     * @return Intelligence
     */
    public function getBaseIntelligence()
    {
        return $this->baseIntelligence;
    }

    /**
     * @param Intelligence $baseIntelligence
     *
     * @throws Exceptions\BasePropertyValueExceeded
     * @return $this
     */
    public function setBaseIntelligence(Intelligence $baseIntelligence)
    {
        $this->setUpProperty($baseIntelligence);

        return $this;
    }

    /**
     * @return int
     */
    public function calculateMaximalBaseIntelligence()
    {
        return $this->calculateMaximalBaseProperty(Intelligence::INTELLIGENCE);
    }

    /**
     * @return Charisma
     */
    public function getBaseCharisma()
    {
        return $this->baseCharisma;
    }

    /**
     * @param Charisma $baseCharisma
     *
     * @throws Exceptions\BasePropertyValueExceeded
     * @return $this
     */
    public function setBaseCharisma(Charisma $baseCharisma)
    {
        $this->setUpProperty($baseCharisma);

        return $this;
    }

    /**
     * @return int
     */
    public function calculateMaximalBaseCharisma()
    {
        return $this->calculateMaximalBaseProperty(Charisma::CHARISMA);
    }
}
