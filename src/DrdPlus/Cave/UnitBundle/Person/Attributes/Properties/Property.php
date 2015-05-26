<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties;

use Doctrineum\Integer\SelfTypedIntegerEnum;

/**
 * @method static Property getType()
 */
abstract class Property extends SelfTypedIntegerEnum
{

    /**
     * @return bool
     */
    public static function registerSelf()
    {
        if (__CLASS__ === static::class) {
            throw new Exceptions\CanNotRegisterAbstractProperty();
        }

        return parent::registerSelf();
    }

    /**
     * @return string
     */
    public static function getTypeName()
    {
        if (__CLASS__ === static::class) {
            throw new Exceptions\AbstractPropertyDoesNotHaveTypeName();
        }

        return parent::getTypeName();
    }

    /**
     * @param int $value
     *
     * @return Property
     */
    public static function getIt($value)
    {
        return static::getEnum($value);
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->getEnumValue();
    }

}
