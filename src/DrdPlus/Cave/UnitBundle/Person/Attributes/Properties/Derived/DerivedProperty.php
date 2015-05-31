<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Derived;

interface DerivedProperty
{
    /**
     * @return int
     */
    public function getValue();

    /**
     * @return string
     */
    public function getName();
}
