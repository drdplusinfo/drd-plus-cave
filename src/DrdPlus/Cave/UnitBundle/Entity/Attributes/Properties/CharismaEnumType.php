<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties;

use Doctrineum\Generic\EnumType;

class CharismaEnumType extends EnumType
{
    // own Doctrine annotation type (overloaded parent constant)
    const TYPE = 'charisma';
    
    /**
     * Overloaded parent method to implement own conversion
     *
     * @param int $charismaValue
     * @return Charisma
     */
    protected function convertToEnum($charismaValue)
    {
        return Charisma::get($charismaValue);
    }
}
