<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities\Choices\ExceptionalityChoice;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities\Kinds\ExceptionalityKind;
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
    private $exceptionalityKind;

    public function __construct(
        ExceptionalityChoice $exceptionalityChoice,
        ExceptionalityKind $exceptionalityKind
    )
    {
        $this->exceptionalityChoice = $exceptionalityChoice;
        $this->exceptionalityKind = $exceptionalityKind;
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
     * @return ExceptionalityKind
     */
    public function getExceptionalityKind()
    {
        return $this->exceptionalityKind;
    }
}
