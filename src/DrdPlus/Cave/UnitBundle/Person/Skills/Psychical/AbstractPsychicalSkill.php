<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills\Psychical;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Will;
use DrdPlus\Cave\UnitBundle\Person\Skills\AbstractSkill;

abstract class AbstractPsychicalSkill extends AbstractSkill
{
    /**
     * @return string[]
     */
    public function getRelatedProperties()
    {
        return [Intelligence::INTELLIGENCE, Will::WILL];
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
        return true;
    }

    /**
     * @return bool
     */
    public function isCombined()
    {
        return false;
    }
}