<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Derived;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrineum\Integer\SelfTypedIntegerEnum;

/**
 * @method static Toughness getType(int $value),
 * @see SelfTypedStrictStringEnum::getType or for original
 * @see \Doctrine\DBAL\Types\Type::getType
 *
 * @method Toughness convertToPHPValue(int $value, AbstractPlatform $platform)
 * @see SelfTypedStrictStringEnum::convertToPHPValue or for original
 * @see EnumType::convertToPHPValue
 *
 * @method static Toughness getEnum(mixed $value)
 * @see SelfTypedStrictStringEnum::getEnum or for original
 * @see EnumTrait::getEnum
 */
class Toughness extends SelfTypedIntegerEnum
{
    const TOUGHNESS = 'toughness';

    /**
     * @param int $value
     * @return Toughness
     */
    public static function getIt($value)
    {
        return static::getEnum($value);
    }
}
