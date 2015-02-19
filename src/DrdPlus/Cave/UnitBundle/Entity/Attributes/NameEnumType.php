<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes;

use Doctrineum\Generic\EnumType;

class NameEnumType extends EnumType
{
    // own Doctrine annotation type (overloaded parent constant)
    const TYPE = 'name';
    
    /**
     * Overloaded parent method to implement own conversion
     *
     * @param string $nameString
     * @return Name
     */
    protected function convertToEnum($nameString)
    {
        return Name::get($nameString);
    }
}
