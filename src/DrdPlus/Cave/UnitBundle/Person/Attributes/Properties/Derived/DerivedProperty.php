<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Derived;

use Doctrineum\Integer\IntegerEnum;

abstract class DerivedProperty extends IntegerEnum
{

    /**
     * @param int $value
     *
     * @return \Doctrineum\Scalar\Enum
     */
    public static function getIt($value)
    {
        return self::getEnum($value);
    }

    /**
     * @return int
     */
    public function getValue() {
        return $this->getEnumValue();
    }

    /**
     * @return string
     */
    abstract public function getName();
}
