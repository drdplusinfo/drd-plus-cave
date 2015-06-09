<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties;

use Doctrineum\Integer\SelfTypedIntegerEnum;

/**
 * @method static BaseProperty getType()
 */
abstract class BaseProperty extends SelfTypedIntegerEnum
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
     * @return BaseProperty
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

    /**
     * @return string
     */
    abstract public function getCode();

}
