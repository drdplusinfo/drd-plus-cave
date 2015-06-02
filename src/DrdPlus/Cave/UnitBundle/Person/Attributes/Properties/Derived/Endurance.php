<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Derived;

class Endurance extends DerivedProperty
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
