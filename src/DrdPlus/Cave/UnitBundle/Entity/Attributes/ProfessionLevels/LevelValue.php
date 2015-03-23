<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels;

use Doctrineum\Integer\SelfTypedIntegerEnum;

/**
 * @method static LevelValue getEnum($value)
 * @see  SelfTypedIntegerEnum::getEnum
 */
class LevelValue extends SelfTypedIntegerEnum
{
    const TYPE_LEVEL_VALUE = 'level_value';

    /**
     * @return int
     */
    public function getRank()
    {
        return $this->getEnumValue();
    }
}
