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
    private $id;

    /**
     * @var Exceptionality|null
     *
     * @ORM\Column(type="exceptionality")
     */
    private $exceptionality;

    /**
     * @var
     *
     * @ORM\Column(type="strength")
     */
    private $strength;

    /**
     * @var
     *
     * @ORM\Column(type="agility")
     */
    private $agility;

    /**
     * @var
     *
     * @ORM\Column(type="knack")
     */
    private $knack;

    /**
     * @var
     *
     * @ORM\Column(type="will")
     */
    private $will;

    /**
     * @var
     *
     * @ORM\Column(type="intelligence")
     */
    private $intelligence;

    /**
     * @var
     *
     * @ORM\Column(type="charisma")
     */
    private $charisma;

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
        if ($exceptionality->getExceptionalityProperties()->getId() !== $this->getId()) {
            throw new \LogicException;
        }

        if (!isset($this->exceptionality)) {
            $this->exceptionality = $exceptionality;
        } elseif ($this->exceptionality->getId() !== $this->getId()) {
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
