<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills;

use Granam\Strict\Object\StrictObject;

abstract class AbstractSkillsGroup extends StrictObject
{
    /**
     * @return int
     */
    abstract public function getSkillRankSummary();
}
