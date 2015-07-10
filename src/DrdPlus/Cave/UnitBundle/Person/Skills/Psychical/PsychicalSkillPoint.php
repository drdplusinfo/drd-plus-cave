<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Psychical;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Will;
use DrdPlus\Cave\UnitBundle\Person\Skills\AbstractSkillPoint;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class PsychicalSkillPoint extends AbstractSkillPoint
{

    const PSYCHICAL = 'psychical';

    /**
     * return @string
     */
    public function getTypeName()
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
