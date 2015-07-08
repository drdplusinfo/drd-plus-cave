<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Choices\ExceptionalityChoice;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Fates\AbstractFateEntity;
use Granam\Strict\Object\StrictObject;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class Exceptionality extends StrictObject
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
     * @var ExceptionalityChoice
     *
     * @ORM\Column(type="exceptionality_choice")
     */
    private $exceptionalityChoice;

    /**
     * @var ExceptionalityChoice
     *
     * @ORM\Column(type="exceptionality_kind")
     */
    private $exceptionalityFate;

    /**
     * @var FortuneProperties|ChosenProperties
     *
     * @ORM\Column(type="exceptionality_properties")
     */
    private $exceptionalityProperties;

    public function __construct(
        ExceptionalityChoice $exceptionalityChoice,
        AbstractFateEntity $exceptionalityKind,
        ExceptionalityProperties $exceptionalityProperties
    )
    {
        $this->exceptionalityChoice = $exceptionalityChoice;
        $this->exceptionalityFate = $exceptionalityKind;
        $exceptionalityProperties->setExceptionality($this);
        $this->exceptionalityProperties = $exceptionalityProperties;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return ExceptionalityChoice
     */
    public function getExceptionalityChoice()
    {
        return $this->exceptionalityChoice;
    }

    /**
     * @return AbstractFateEntity
     */
    public function getExceptionalityFate()
    {
        return $this->exceptionalityFate;
    }

    /**
     * @return ExceptionalityProperties
     */
    public function getExceptionalityProperties()
    {
        return $this->exceptionalityProperties;
    }

}
