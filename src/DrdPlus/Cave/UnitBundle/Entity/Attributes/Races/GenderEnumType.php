<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races;

use Doctrineum\Generic\EnumType;

class GenderEnumType extends EnumType
{
    // own Doctrine annotation type (overloaded parent constant)
    const TYPE = 'gender';
    
    /**
     * Overloaded parent method to implement own conversion
     *
     * @param string $raceAndSubraceCode
     * @return Gender
     */
    protected function convertToEnum($raceAndSubraceCode)
    {
        return Gender::get($raceAndSubraceCode);
    }
}
