<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills;

use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevel;
use Granam\Strict\Object\StrictObject;

abstract class AbstractSkillsGroup extends StrictObject
{
    /**
     * @return int
     */
    abstract public function getNextLevelsSkillRankSummary();

    /**
     * @return int
     */
    abstract public function getFirstLevelsSkillRankSummary();

    // TODO move this out for DI
    protected function createZeroSkillRank(ProfessionLevel $professionLevel)
    {
        $zeroSkillPoint = ZeroSkillPoint::getIt($professionLevel);
        $requiredRankValue = new RequiredRankValue(0);
        $zeroSkillRank = new ZeroSkillRank($professionLevel, $zeroSkillPoint, $requiredRankValue);

        return $zeroSkillRank;
    }
}
