<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes;

use Doctrineum\Scalar\Enum;

/**
 * @method static Name getEnum(string $name)
 */
class Name extends Enum
{
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
        return strlen($this->getValue()) === 0;
    }
}
