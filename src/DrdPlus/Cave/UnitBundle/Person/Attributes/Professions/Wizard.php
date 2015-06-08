<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Professions;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Will;

class Wizard extends Profession
{
    const WIZARD = 'wizard';

    /**
     * @return string[]
     */
    public function getPrimaryPropertyCodes()
    {
        return [Will::WILL, Intelligence::INTELLIGENCE];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return self::WIZARD;
    }

}
