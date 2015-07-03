<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills;

use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevel;
use Granam\Integer\IntegerInterface;
use Granam\Integer\IntegerObject;
use Granam\Strict\Object\StrictObject;

abstract class AbstractSkillRank extends StrictObject implements IntegerInterface
{
    const MIN_RANK_VALUE = 0;
    const MAX_RANK_VALUE = 3;
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var ProfessionLevel
     *
     * @ORM\ManyToOne(targetEntity="\DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevel")
     */
    private $professionLevel;
    /**
     * @var AbstractSkillPoint
     *
     * @ORM\OneToOne(targetEntity="\DrdPlus\Cave\UnitBundle\Person\Skills\AbstractSkillPoint")
     */
    private $skillPoint;
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $value;

    /**
     * @param ProfessionLevel $professionLevel
     * @param AbstractSkillPoint $skillPoint
     * @param IntegerObject $requiredRankValue
     */
    protected function __construct(ProfessionLevel $professionLevel, AbstractSkillPoint $skillPoint, IntegerObject $requiredRankValue)
    {
        $this->professionLevel = $professionLevel; // skill rank has been achieved on this profession level
        $this->skillPoint = $skillPoint; // this skill point has been consumed to achieve this rank
        $this->checkRequiredRankValue($requiredRankValue);
        $this->value = $requiredRankValue->getValue();
    }

    private function checkRequiredRankValue(IntegerObject $requiredRankValue)
    {
        if ($requiredRankValue->getValue() < static::MIN_RANK_VALUE || $requiredRankValue->getValue() > static::MAX_RANK_VALUE) {
            throw new \LogicException(
                'Rank value can not be lower then ' . static::MIN_RANK_VALUE . ' and greater then ' . static::MAX_RANK_VALUE
            );
        }
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return ProfessionLevel
     */
    public function getProfessionLevel()
    {
        return $this->professionLevel;
    }

    /**
     * @return AbstractSkillPoint
     */
    public function getSkillPoint()
    {
        return $this->skillPoint;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->getValue();
    }
}
