<?php
namespace DrdPlus\Cave\UnitBundle\Person\Professions;

use Granam\Strict\Object\StrictObject;

abstract class Profession extends StrictObject
{
    /**
     * @return string[]
     */
    abstract public function getPrimaryPropertyCodes();

    /**
     * @return string
     */
    abstract public function getName();
}
