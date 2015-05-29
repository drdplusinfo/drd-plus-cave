<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Derived;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrineum\Integer\SelfTypedIntegerEnum;

/**
 * @method static Endurance getType(int $value),
 * @see SelfTypedStrictStringEnum::getType or for original
 * @see \Doctrine\DBAL\Types\Type::getType
 *
 * @method Endurance convertToPHPValue(int $value, AbstractPlatform $platform)
 * @see SelfTypedStrictStringEnum::convertToPHPValue or for original
 * @see EnumType::convertToPHPValue
 *
 * @method static Endurance getEnum(mixed $value)
 * @see SelfTypedStrictStringEnum::getEnum or for original
 * @see EnumTrait::getEnum
 */
class Endurance extends SelfTypedIntegerEnum implements DerivedProperty
{
    const ENDURANCE = 'endurance';

    /**
     * @param int $value
     * @return Endurance
     */
    public static function getIt($value)
    {
        return static::getEnum($value);
    }
}
