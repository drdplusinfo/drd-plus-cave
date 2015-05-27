<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels;

use DrdPlus\Cave\UnitBundle\Tests\Person\Attributes\ProfessionLevels\AbstractTestOfProfessionLevel;

class TheurgistLevelTest extends AbstractTestOfProfessionLevel
{

    protected function getCharismaFirstLevelModifier()
    {
        return 1;
    }

    protected function getIntelligenceFirstLevelModifier()
    {
        return 1;
    }

}
