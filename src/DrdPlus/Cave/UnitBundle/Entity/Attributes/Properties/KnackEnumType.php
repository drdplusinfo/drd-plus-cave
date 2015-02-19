<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties;

use Doctrineum\Generic\EnumType;

class KnackEnumType extends EnumType
{
    // own Doctrine annotation type (overloaded parent constant)
    const TYPE = 'knack';
    
    /**
     * Overloaded parent method to implement own conversion
     *
     * @param int $knack
     * @return Knack
     */
    protected function convertToEnum($knack)
    {
        return Knack::get($knack);
    }
}
