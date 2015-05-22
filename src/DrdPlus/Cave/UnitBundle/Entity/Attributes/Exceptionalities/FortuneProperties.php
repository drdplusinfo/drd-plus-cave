<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities;

/**
 * FortuneProperties
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class FortuneProperties
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
     */
    private $exceptionality;

    /**
     * @var
     */
    private $strengthDiceRoll;

    private $agilityDiceRoll;

    private $knackDiceRoll;

    private $willDiceRoll;

    private $intelligenceDiceRoll;

    private $charismaDiceRoll;

    public function __construct(
        $strengthDiceRoll,
        $agilityDiceRoll,
        $knackDiceRoll,
        $willDiceRoll,
        $intelligenceDiceRoll,
        $charismaDiceRoll
    )
    {
        $this->strengthDiceRoll = $strengthDiceRoll;
        $this->agilityDiceRoll = $agilityDiceRoll;
        $this->knackDiceRoll = $knackDiceRoll;
        $this->willDiceRoll = $willDiceRoll;
        $this->intelligenceDiceRoll = $intelligenceDiceRoll;
        $this->charismaDiceRoll = $charismaDiceRoll;
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
        if ($exceptionality->getFortuneProperties()->getId() !== $this->getId()) {
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

}
