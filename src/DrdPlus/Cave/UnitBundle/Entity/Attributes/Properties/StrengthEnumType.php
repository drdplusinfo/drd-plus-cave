<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties;

use Doctrineum\Generic\EnumType;

class StrengthEnumType extends EnumType
{
    // own Doctrine annotation type (overloaded parent constant)
    const TYPE = 'strength';
    
    /**
     * Overloaded parent method to implement own conversion
     *
     * @param int $strengthValue
     * @return Strength
     */
    protected function convertToEnum($strengthValue)
    {
        return Strength::get($strengthValue);
    }
}
