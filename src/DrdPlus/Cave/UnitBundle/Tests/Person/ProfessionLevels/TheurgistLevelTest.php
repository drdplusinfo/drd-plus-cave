<?php
namespace DrdPlus\Cave\UnitBundle\Person\ProfessionLevels;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Tests\Person\ProfessionLevels\AbstractTestOfProfessionLevel;

class TheurgistLevelTest extends AbstractTestOfProfessionLevel
{

    /**
     * @return string[]
     */
    protected function getPrimaryProperties()
    {
        return [Intelligence::INTELLIGENCE, Charisma::CHARISMA];
    }

}
