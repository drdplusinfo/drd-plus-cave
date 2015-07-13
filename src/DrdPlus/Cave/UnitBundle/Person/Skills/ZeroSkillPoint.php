<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Person\Background\BackgroundSkills;
use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevel;

/**
 * @ORM\Table
 */
class ZeroSkillPoint extends AbstractSkillPoint
{

    const ZERO = 'zero';

    /**
     * @param ProfessionLevel $professionLevel
     *
     * @return static
     */
    public static function getIt(ProfessionLevel $professionLevel)
    {
        return new static($professionLevel);
    }

    /**
     * @param ProfessionLevel $professionLevel
     *
     * @return static
     */
    public static function createByRelatedPropertyIncrease(ProfessionLevel $professionLevel)
    {
        return static::getIt($professionLevel);
    }

    public static function createByFirstLevelBackgroundSkills(ProfessionLevel $professionLevel, BackgroundSkills $backgroundSkills)
    {
        throw new \LogicException("There is no sense to create zero skill level by background skills");
    }

    public static function createFromCrossGroupSkillPoints(ProfessionLevel $professionLevel, AbstractSkillPoint $firstPaidSkillPoint, AbstractSkillPoint $secondPaidSkillPoint)
    {
        throw new \LogicException("There is no sense to create zero skill level from other skill points");
    }

    protected function checkPaidProperties(ProfessionLevel $professionLevel, BackgroundSkills $backgroundSkills = null, AbstractSkillPoint $firstPaidSkillPoint = null, AbstractSkillPoint $secondPaidSkillPoint = null)
    {
        // zero skill level has just a single condition
        if (!$professionLevel->isFirstLevel()) {
            throw new \LogicException("zero skill point has sense only for first level, got {$professionLevel->getLevelRank()->getValue()}");
        }
    }

    /**
     * return @string
     */
    public function getTypeName()
    {
        return static::ZERO;
    }

    /**
     * @return string[]
     */
    public function getRelatedProperties()
    {
        return [];
    }

}
