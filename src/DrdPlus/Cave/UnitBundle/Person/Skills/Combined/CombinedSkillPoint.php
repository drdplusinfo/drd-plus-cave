<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Combined;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevel;
use DrdPlus\Cave\UnitBundle\Person\Skills\AbstractSkillPoint;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table
 */
class CombinedSkillPoint extends AbstractSkillPoint
{

    const COMBINED = 'combined';

    /**
     * @param ProfessionLevel $professionLevel
     *
     * @return static
     */
    public static function createByRelatedPropertyIncrease(ProfessionLevel $professionLevel)
    {
        return new static($professionLevel);
    }

    /**
     * @param ProfessionLevel $professionLevel
     * @param AbstractSkillPoint $firstPaidSkillPoint
     * @param AbstractSkillPoint $secondPaidSkillPoint
     *
     * @return static
     */
    public static function createFromCrossGroupSkillPoints(ProfessionLevel $professionLevel, AbstractSkillPoint $firstPaidSkillPoint, AbstractSkillPoint $secondPaidSkillPoint)
    {
        return new static($professionLevel, $firstPaidSkillPoint, $secondPaidSkillPoint);
    }

    /**
     * return @string
     */
    public function getGroupName()
    {
        return static::COMBINED;
    }

    /**
     * @return string[]
     */
    public function getRelatedProperties()
    {
        return [Knack::KNACK, Charisma::CHARISMA];
    }

}
