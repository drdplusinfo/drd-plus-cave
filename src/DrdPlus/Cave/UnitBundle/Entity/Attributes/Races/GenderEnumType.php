<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races;

use Doctrineum\EnumType;

class GenderEnumType extends EnumType
{
    // own Doctrine annotation type (overloaded parent constant)
    const TYPE = 'gender';
    
    /**
     * Overloaded parent method to implement own conversion
     *
     * @param string $raceCode
     * @return Gender
     */
    protected function convertToEnum($raceCode)
    {
        return Gender::get($raceCode);
    }
}
