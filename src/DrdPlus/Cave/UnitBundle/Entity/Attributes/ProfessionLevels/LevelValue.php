<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels;

use Doctrineum\Integer\SelfTypedIntegerEnum;

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
