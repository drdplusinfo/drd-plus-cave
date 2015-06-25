<?php
namespace DrdPlus\Cave\UnitBundle\Person\Professions;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Will;

class Priest extends Profession
{
    const PRIEST = 'priest';

    /**
     * @return string[]
     */
    public function getPrimaryPropertyCodes()
    {
        return [Will::WILL, Charisma::CHARISMA];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return self::PRIEST;
    }

}
