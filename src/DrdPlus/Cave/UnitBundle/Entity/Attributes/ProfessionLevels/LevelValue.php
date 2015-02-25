<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels;

use Doctrineum\Integer\IntegerSelfTypedEnum;

class LevelValue extends IntegerSelfTypedEnum
{

    /**
     * Using own namespace to avoid conflicts with other enums
     *
     * @param string $enumValue
     * @param string $namespace
     * @return IntegerSelfTypedEnum
     */
    public static function getEnum($enumValue, $namespace = __CLASS__)
    {
        return parent::getEnum($enumValue, $namespace);
    }

    public static function getTypeName()
    {
        return 'level_value';
    }
}
