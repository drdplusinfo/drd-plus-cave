<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Derived;

interface DerivedProperty
{
    /**
     * @param int $value
     *
     * @return self
     */
    public static function getIt($value);

    /**
     * @return string
     */
    public function getName();
}
