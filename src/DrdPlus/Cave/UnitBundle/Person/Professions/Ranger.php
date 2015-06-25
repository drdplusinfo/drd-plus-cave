<?php
namespace DrdPlus\Cave\UnitBundle\Person\Professions;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Strength;

class Ranger extends Profession
{
    const RANGER = 'ranger';

    /**
     * @return string[]
     */
    public function getPrimaryPropertyCodes()
    {
        return [Strength::STRENGTH, Knack::KNACK];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return self::RANGER;
    }

}
