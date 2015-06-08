<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Professions;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Knack;

class Thief extends Profession
{
    const THIEF = 'thief';

    /**
     * @return string[]
     */
    public function getPrimaryPropertyCodes()
    {
        return [Agility::AGILITY, Knack::KNACK];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return self::THIEF;
    }

}
