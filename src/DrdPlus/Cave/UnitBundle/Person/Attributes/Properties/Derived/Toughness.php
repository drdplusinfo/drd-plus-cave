<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Derived;

use Granam\Strict\Integer\StrictInteger;

class Toughness extends StrictInteger implements DerivedProperty
{
    const TOUGHNESS = 'toughness';

    public function getName()
    {
        return self::TOUGHNESS;
    }
}