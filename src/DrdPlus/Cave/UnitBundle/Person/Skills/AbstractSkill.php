<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills;

use Granam\Strict\Object\StrictObject;

abstract class AbstractSkill extends StrictObject
{
    /**
     * @return string[]
     */
    abstract public function getRelatedProperties();

    /**
     * @return mixed
     */
    abstract public function getTier();

    /**
     * @return bool
     */
    abstract public function isPhysical();

    /**
     * @return bool
     */
    abstract public function isPsychical();

    /**
     * @return bool
     */
    abstract public function isCombined();

}
