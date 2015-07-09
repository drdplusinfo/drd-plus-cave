<?php
namespace DrdPlus\Cave\UnitBundle\Person\ProfessionLevels;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Will;
use DrdPlus\Cave\UnitBundle\Tests\Person\ProfessionLevels\AbstractTestOfProfessionLevel;

class WizardLevelTest extends AbstractTestOfProfessionLevel
{

    /**
     * @return string[]
     */
    protected function getPrimaryProperties()
    {
        return [Will::WILL, Intelligence::INTELLIGENCE];
    }

}
