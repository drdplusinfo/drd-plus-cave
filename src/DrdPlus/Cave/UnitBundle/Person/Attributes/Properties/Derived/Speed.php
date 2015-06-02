<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Derived;

class Speed extends DerivedProperty
{
    const SPEED = 'speed';

    public function getName()
    {
        return self::SPEED;
    }
}
