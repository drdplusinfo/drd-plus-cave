<?php
namespace DrdPlus\Cave\UnitBundle\Person\ProfessionLevels;

use Doctrineum\Integer\SelfTypedIntegerEnum;

/**
 * @method static LevelRank getEnum($value)
 * @see  SelfTypedIntegerEnum::getEnum
 */
class LevelRank extends SelfTypedIntegerEnum
{
    const LEVEL_RANK = 'level_rank';

    /**
     * @param int $value
     *
     * @return LevelRank
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
