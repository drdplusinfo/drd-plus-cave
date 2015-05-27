<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels;

use DrdPlus\Cave\UnitBundle\Tests\Person\Attributes\ProfessionLevels\AbstractTestOfProfessionLevel;

class PriestLevelTest extends AbstractTestOfProfessionLevel
{

    protected function getWillFirstLevelModifier()
    {
        return 1;
    }

    protected function getCharismaFirstLevelModifier()
    {
        return 1;
    }

}
