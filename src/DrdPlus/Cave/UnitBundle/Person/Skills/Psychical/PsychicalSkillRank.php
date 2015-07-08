<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Psychical;

use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevel;
use DrdPlus\Cave\UnitBundle\Person\Skills\AbstractSkillRank;
use DrdPlus\Cave\UnitBundle\Person\Skills\RequiredRankValue;
use Doctrine\Common\Annotations as ORM;

/**
 * @ORM\Table
 * @ORM\Entity
 */
class PsychicalSkillRank extends AbstractSkillRank
{
    public function __construct(ProfessionLevel $professionLevel, PsychicalSkillPoint $skillPoint, RequiredRankValue $requiredRankValue)
    {
        parent::__construct($professionLevel, $skillPoint, $requiredRankValue);
    }
}
