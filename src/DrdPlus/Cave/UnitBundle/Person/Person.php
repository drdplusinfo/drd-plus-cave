<?php
namespace DrdPlus\Cave\UnitBundle\Person;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Exceptionality;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Name;
use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\ProfessionLevels;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Derived\Toughness;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\BaseProperties;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Gender;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Race;
use Granam\Strict\Object\StrictObject;

/**
 * Person
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Person extends StrictObject
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
     * @var Name
     *
     * @ORM\Column(type="name")
     */
    private $name;

    /**
     * @var Race
     *
     * @ORM\Column(type="race")
     */
    private $race;

    /**
     * @var Gender
     *
     * @ORM\Column(type="gender")
     */
    private $gender;

    /**
     * @var BaseProperties
     *
     * @ORM\Column(type="exceptionality")
     */
    private $exceptionality;

    /**
     * @var BaseProperties
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\BaseProperties")
     */
    private $baseProperties;

    /**
     * @var ProfessionLevels
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\ProfessionLevels")
     */
    private $professionLevels;

    /**
     * @var Toughness
     */
    private $toughness;

    /** @var  Strength */
    private $currentStrength;

    public function __construct(
        Race $race, // enum
        Gender $gender, // enum
        Name $name, // enum
        Exceptionality $exceptionality, // entity
        BaseProperties $baseProperties, // entity
        ProfessionLevels $professionLevels // entity
    )
    {
        $this->race = $race;
        $this->gender = $gender;
        $this->name = $name;
        $exceptionality->setPerson($this);
        $this->exceptionality = $exceptionality;
        $baseProperties->setPerson($this);
        $this->baseProperties = $baseProperties;
        $professionLevels->setPerson($this);
        $this->professionLevels = $professionLevels;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Name is an enum, therefore de facto a constant, therefore only way how to change the name is to replace it
     *
     * @param Name $name
     *
     * @return $this
     */
    public function setName(Name $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Race
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * @return Gender
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @return BaseProperties
     */
    public function getBaseProperties()
    {
        return $this->baseProperties;
    }

    /**
     * @return Exceptionality
     */
    public function getExceptionality()
    {
        return $this->exceptionality;
    }

    /**
     * @return ProfessionLevels
     */
    public function getProfessionLevels()
    {
        return $this->professionLevels;
    }

    /**
     * @return Toughness
     */
    public function getToughness()
    {
        if (!isset($this->toughness)) {
            $this->toughness = Toughness::getIt($this->calculateCurrentToughness());
        }

        return $this->toughness;
    }

    /**
     * @return int
     */
    private function calculateCurrentToughness()
    {
        return $this->getCurrentStrength()->getValue();
    }

    /**
     * @return Strength
     */
    public function getCurrentStrength()
    {
        if (!isset($this->currentStrength)) {
            $this->currentStrength = Strength::getIt($this->calculateCurrentStrength());
        }

        return $this->currentStrength;
    }

    /**
     * @return int
     */
    private function calculateCurrentStrength()
    {
        return
            $this->getProfessionLevels()->getStrengthIncrementSummary()
            + $this->getBaseProperties()->getBaseStrength()->getValue()
            + $this->getExceptionality()->getExceptionalityProperties()->getStrength()->getValue()
            + $this->getRace()->getStrengthModifier($this->getGender());
    }

}
