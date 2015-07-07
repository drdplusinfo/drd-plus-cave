<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Combined;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Person\Skills\AbstractSkillPoint;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table
 */
class CombinedSkillPoint extends AbstractSkillPoint
{

    const COMBINED = 'combined';

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
