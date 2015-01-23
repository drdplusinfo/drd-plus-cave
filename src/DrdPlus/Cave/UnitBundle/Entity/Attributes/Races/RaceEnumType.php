<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races;

use Doctrineum\EnumType;

class RaceEnumType extends EnumType
{
    // own Doctrine annotation type
    const TYPE = 'race';
    
    /**
     * Overloaded parent method to implement own conversion
     *
     * @param string $raceCode
     * @return Race|null
     */
    protected function convertToEnum($raceCode)
    {
        if (is_null($raceCode)) {
            return null;
        }

        return Race::get($raceCode);
    }
}
