<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Physical;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Person\Skills\AbstractSkill;

abstract class AbstractPhysicalSkill extends AbstractSkill
{
    /**
     * @return string[]
     */
    public function getRelatedProperties()
    {
        return [Strength::STRENGTH, Agility::AGILITY];
    }

    /**
     * @return bool
     */
    public function isPhysical()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isPsychical()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isCombined()
    {
        return false;
    }
}
