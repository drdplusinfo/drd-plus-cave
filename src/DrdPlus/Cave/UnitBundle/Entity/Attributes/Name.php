<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes;

use Doctrineum\Strict\String\SelfTypedStrictStringEnum;

class Name extends SelfTypedStrictStringEnum
{
    const TYPE_NAME = 'name';

    /**
     * @param string $nameString
     * @param string $namespace
     * @return Name
     */
    public static function getEnum($nameString, $namespace = __CLASS__)
    {
        return parent::getEnum(trim($nameString), $namespace);
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return strlen($this->getEnumValue()) === 0;
    }

    /**
     * Gets the strongly recommended name of this type.
     * Its used at @see \Doctrine\DBAL\Platforms\AbstractPlatform::getDoctrineTypeComment
     * @see EnumType::getName for direct usage
     *
     * @return string
     */
    public static function getTypeName()
    {
        return static::TYPE_NAME;
    }
}
