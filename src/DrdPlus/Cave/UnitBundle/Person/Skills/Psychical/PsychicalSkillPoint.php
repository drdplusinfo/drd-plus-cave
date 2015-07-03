<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Psychical;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Will;
use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevel;
use DrdPlus\Cave\UnitBundle\Person\Skills\AbstractSkillPoint;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class PsychicalSkillPoint extends AbstractSkillPoint
{

    const PSYCHICAL = 'psychical';

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
        return static::PSYCHICAL;
    }

    /**
     * @return string[]
     */
    public function getRelatedProperties()
    {
        return [Will::WILL, Intelligence::INTELLIGENCE];
    }

}
