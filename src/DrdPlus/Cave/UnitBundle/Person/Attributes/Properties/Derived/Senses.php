<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Derived;

use Granam\Strict\Integer\StrictInteger;

class Senses extends StrictInteger implements DerivedProperty
{
    const SPEED = 'speed';

    public function getName()
    {
        return self::SPEED;
    }
}
