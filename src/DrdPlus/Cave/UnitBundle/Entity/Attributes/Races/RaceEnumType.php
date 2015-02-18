<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races;

use Doctrineum\Generic\EnumType;

class RaceEnumType extends EnumType
{
    // own Doctrine annotation type
    const TYPE = 'race';
    
    /**
     * Overloaded parent method to implement own conversion
     *
     * @param string $raceAndSubraceCode
     * @return Race|null
     */
    protected function convertToEnum($raceAndSubraceCode)
    {
        if (is_null($raceAndSubraceCode)) {
            return null;
        }

        return Race::get($raceAndSubraceCode);
    }
}
