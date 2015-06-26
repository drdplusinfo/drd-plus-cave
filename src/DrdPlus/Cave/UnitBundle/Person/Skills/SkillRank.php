<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills;

use Doctrineum\Integer\SelfTypedIntegerEnum;

/**
 * @method static SkillRank getEnum($value)
 * @see  SelfTypedIntegerEnum::getEnum
 */
class SkillRank extends SelfTypedIntegerEnum
{
    const SKILL_RANK = 'skill_rank';

    /**
     * @param int $value
     * @return static
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

