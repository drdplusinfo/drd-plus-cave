<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Will;
use Granam\Strict\Object\StrictObject;

abstract class ExceptionalityProperties extends StrictObject
{

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Exceptionality|null
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Exceptionality")
     */
    protected $exceptionality;

    /**
     * @var Strength
     *
     * @ORM\Column(type="strength")
     */
    protected $strength;

    /**
     * @var Agility
     *
     * @ORM\Column(type="agility")
     */
    protected $agility;

    /**
     * @var Knack
     *
     * @ORM\Column(type="knack")
     */
    protected $knack;

    /**
     * @var Will
     *
     * @ORM\Column(type="will")
     */
    protected $will;

    /**
     * @var Intelligence
     *
     * @ORM\Column(type="intelligence")
     */
    protected $intelligence;

    /**
     * @var Charisma
     *
     * @ORM\Column(type="charisma")
     */
    protected $charisma;

    public function __construct(
        Strength $strength,
        Agility $agility,
        Knack $knack,
        Will $will,
        Intelligence $intelligence,
        Charisma $charisma
    )
    {
        $this->strength = $strength;
        $this->agility = $agility;
        $this->knack = $knack;
        $this->will = $will;
        $this->intelligence = $intelligence;
        $this->charisma = $charisma;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function setExceptionality(Exceptionality $exceptionality)
    {
        $this->checkExceptionalityToSet($exceptionality);
        $this->exceptionality = $exceptionality; // instance of same ID is replaced anyway
    }

    private function checkExceptionalityToSet(Exceptionality $exceptionality)
    {
        if (is_null($this->getId()) && is_null($exceptionality->getExceptionalityProperties()->getId())
            && $this !== $exceptionality->getExceptionalityProperties()
        ) {
            throw new \LogicException;
        }

        if ($exceptionality->getExceptionalityProperties()->getId() !== $this->getId()) {
            throw new \LogicException;
        }

        if ($this->getExceptionality() && $this->getExceptionality()->getId() !== $exceptionality->getId()) {
            throw new \LogicException;
        }
    }

    /**
     * @return Exceptionality|null
     */
    public function getExceptionality()
    {
        return $this->exceptionality;
    }

    /**
     * @return Strength
     */
    public function getStrength()
    {
        return $this->strength;
    }

    /**
     * @return Agility
     */
    public function getAgility()
    {
        return $this->agility;
    }

    /**
     * @return Knack
     */
    public function getKnack()
    {
        return $this->knack;
    }

    /**
     * @return Will
     */
    public function getWill()
    {
        return $this->will;
    }

    /**
     * @return Intelligence
     */
    public function getIntelligence()
    {
        return $this->intelligence;
    }

    /**
     * @return Charisma
     */
    public function getCharisma()
    {
        return $this->charisma;
    }

}
