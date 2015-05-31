<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Derived;

use Granam\Strict\Integer\StrictInteger;

class Endurance extends StrictInteger implements DerivedProperty
{
    const ENDURANCE = 'endurance';

    /**
     * @return string
     */
    public function getName()
    {
        return self::ENDURANCE;
    }
}
