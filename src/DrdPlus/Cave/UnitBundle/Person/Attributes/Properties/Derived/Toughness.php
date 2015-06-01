<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Derived;

class Toughness extends DerivedProperty
{
    const TOUGHNESS = 'toughness';

    public function getName()
    {
        return self::TOUGHNESS;
    }
}
