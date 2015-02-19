<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties;

use Doctrineum\Generic\EnumType;

class AgilityEnumType extends EnumType
{
    // own Doctrine annotation type (overloaded parent constant)
    const TYPE = 'agility';
    
    /**
     * Overloaded parent method to implement own conversion
     *
     * @param int $agilityValue
     * @return Agility
     */
    protected function convertToEnum($agilityValue)
    {
        return Agility::get($agilityValue);
    }
}
