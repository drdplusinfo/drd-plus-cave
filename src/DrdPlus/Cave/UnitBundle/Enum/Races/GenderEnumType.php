<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races;

use Doctrineum\EnumType;

class GenderEnumType extends EnumType
{
    // own Doctrine annotation type (overloaded parent constant)
    const TYPE = 'gender';
    
    /**
     * Overloaded parent method to implement own conversion
     *
     * @param string $raceCode
     * @return Gender|null
     */
    protected function convertToEnum($raceCode)
    {
        if (is_null($raceCode)) {
            return null;
        }

        return Gender::get($raceCode);
    }
}
