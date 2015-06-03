<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels;

use Doctrineum\Integer\SelfTypedIntegerEnum;

/**
 * @method static LevelValue getEnum($value)
 * @see  SelfTypedIntegerEnum::getEnum
 */
class LevelValue extends SelfTypedIntegerEnum
{
    const LEVEL_VALUE = 'level_value';

    /**
     * @param int $value
     * @return LevelValue
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
