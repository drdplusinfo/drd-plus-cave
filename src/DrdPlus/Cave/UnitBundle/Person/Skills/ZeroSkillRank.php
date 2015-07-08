<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills;

use Doctrine\Common\Annotations as ORM;
use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevel;

/**
 * @ORM\Table
 * @ORM\Entity
 */
class ZeroSkillRank extends AbstractSkillRank
{
    public function __construct(ProfessionLevel $professionLevel, ZeroSkillPoint $skillPoint, RequiredRankValue $requiredRankValue)
    {
        if ($requiredRankValue->getValue() !== 0) {
            throw new \LogicException(
                "Zero skill rank can be requested for zero rank only, got request for {$requiredRankValue->getValue()}"
            );
        }
        parent::__construct($professionLevel, $skillPoint, $requiredRankValue);
    }
}
