<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties;

use Doctrineum\Integer\SelfTypedIntegerEnum;

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
     * @return int
     */
    public function getValue()
    {
        return $this->getEnumValue();
    }

}
