<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Physical;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Person\Skills\AbstractSkillPoint;
use Doctrine\ORM\Mapping as ORM;

class PhysicalSkillPoint extends AbstractSkillPoint
{

    const PHYSICAL = 'physical';

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
