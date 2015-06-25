<?php
namespace DrdPlus\Cave\UnitBundle\Person\Professions;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Strength;

class Fighter extends Profession
{
    const FIGHTER = 'fighter';

    /**
     * @return string[]
     */
    public function getPrimaryPropertyCodes()
    {
        return [Strength::STRENGTH, Agility::AGILITY];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return self::FIGHTER;
    }

}
