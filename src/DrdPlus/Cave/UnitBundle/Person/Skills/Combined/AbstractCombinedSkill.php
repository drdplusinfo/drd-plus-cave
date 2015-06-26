<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Combined;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Person\Skills\AbstractSkill;

abstract class AbstractCombinedSkill extends AbstractSkill
{
    /**
     * @return string[]
     */
    public function getRelatedProperties()
    {
        return [Knack::KNACK, Charisma::CHARISMA];
    }

    /**
     * @return bool
     */
    public function isPhysical()
    {
        return false;
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
        return true;
    }

}
