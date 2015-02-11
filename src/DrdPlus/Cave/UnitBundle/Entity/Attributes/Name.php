<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes;

use Doctrineum\StrictString\StrictStringEnum;

class Name extends StrictStringEnum
{
    /**
     * @param string $nameString
     * @param string $namespace
     * @return Name
     */
    public static function get($nameString, $namespace = __CLASS__)
    {
        return parent::get($nameString, $namespace);
    }
}
