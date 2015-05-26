<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes;

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
    const NAME = 'name';

    /**
     * @param string $name
     *
     * @return Name
     */
    public static function getIt($name)
    {
        return static::getEnum($name);
    }

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
