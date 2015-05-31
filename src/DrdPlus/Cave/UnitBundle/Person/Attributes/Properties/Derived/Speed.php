<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Derived;

use Granam\Strict\Integer\StrictInteger;

class Speed extends StrictInteger implements DerivedProperty
{
    const SPEED = 'speed';

    public function getName()
    {
        return self::SPEED;
    }
}
