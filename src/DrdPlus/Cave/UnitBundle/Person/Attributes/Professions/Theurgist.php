<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Professions;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Intelligence;

class Theurgist extends Profession
{
    const THEURGIST = 'theurgist';

    /**
     * @return string[]
     */
    public function getPrimaryPropertyCodes()
    {
        return [Intelligence::INTELLIGENCE, Charisma::CHARISMA];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return self::THEURGIST;
    }

}
