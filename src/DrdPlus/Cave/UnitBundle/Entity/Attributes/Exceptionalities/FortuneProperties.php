<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities;

use DrdPlus\Cave\ToolsBundle\Dices\Roll;
use Granam\Strict\Object\StrictObject;

/**
 * FortuneProperties
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class FortuneProperties extends StrictObject implements ExceptionalityProperties
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
     * @var Roll
     */
    private $strengthRoll;

    /**
     * @var Roll
     */
    private $agilityRoll;


    /**
     * @var Roll
     */
    private $knackRoll;


    /**
     * @var Roll
     */
    private $willRoll;


    /**
     * @var Roll
     */
    private $intelligenceRoll;


    /**
     * @var Roll
     */
    private $charismaRoll;

    public function __construct(
        Roll $strengthRoll,
        Roll $agilityRoll,
        Roll $knackRoll,
        Roll $willRoll,
        Roll $intelligenceRoll,
        Roll $charismaRoll
    )
    {
        $this->strengthRoll = $strengthRoll;
        $this->agilityRoll = $agilityRoll;
        $this->knackRoll = $knackRoll;
        $this->willRoll = $willRoll;
        $this->intelligenceRoll = $intelligenceRoll;
        $this->charismaRoll = $charismaRoll;
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
     * @return int
     */
    public function getStrengthModifier()
    {
        return $this->strengthRoll->getRollSummary();
    }

    /**
     * @return int
     */
    public function getAgilityModifier()
    {
        return $this->agilityRoll->getRollSummary();
    }

    /**
     * @return int
     */
    public function getKnackModifier()
    {
        return $this->knackRoll->getRollSummary();
    }

    /**
     * @return int
     */
    public function getWillModifier()
    {
        return $this->willRoll->getRollSummary();
    }

    /**
     * @return int
     */
    public function getIntelligenceModifier()
    {
        return $this->intelligenceRoll->getRollSummary();
    }

    /**
     * @return int
     */
    public function getCharismaModifier()
    {
        return $this->charismaRoll->getRollSummary();
    }

}
