<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\PHYSICAL;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevel;
use DrdPlus\Cave\UnitBundle\Person\Skills\AbstractSkillPoint;
use Doctrine\ORM\Mapping as ORM;

class PhysicalSkillPoint extends AbstractSkillPoint
{

    const PHYSICAL = 'physical';

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
    public static function createFromSkillPoints(ProfessionLevel $professionLevel, AbstractSkillPoint $firstPaidSkillPoint, AbstractSkillPoint $secondPaidSkillPoint)
    {
        return new static($professionLevel, $firstPaidSkillPoint, $secondPaidSkillPoint);
    }

    /**
     * return @string
     */
    public function getGroupName()
    {
        return static::PHYSICAL;
    }

    /**
     * @return string[]
     */
    public function getRelatedProperties()
    {
        return [Strength::STRENGTH, Agility::AGILITY];
    }

}
