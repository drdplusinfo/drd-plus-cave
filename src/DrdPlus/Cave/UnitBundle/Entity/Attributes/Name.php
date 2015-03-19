<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes;

use Doctrineum\Strict\String\SelfTypedStrictStringEnum;

/**
 * @method static Name getEnum
 */
class Name extends SelfTypedStrictStringEnum
{
    /**
     * Its not directly used this library - the exactly same value is generated and used by
     * @see \Doctrineum\Scalar\SelfTypedEnum::getTypeName
     *
     * This constant exists to follow Doctrine type conventions.
     */
    const TYPE_NAME = 'name';

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return strlen($this->getEnumValue()) === 0;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->getEnumValue();
    }

}
