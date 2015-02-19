<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties;

use Doctrineum\Generic\EnumType;

class WillEnumType extends EnumType
{
    // own Doctrine annotation type (overloaded parent constant)
    const TYPE = 'will';
    
    /**
     * Overloaded parent method to implement own conversion
     *
     * @param int $will
     * @return Will
     */
    protected function convertToEnum($will)
    {
        return Will::get($will);
    }
}
