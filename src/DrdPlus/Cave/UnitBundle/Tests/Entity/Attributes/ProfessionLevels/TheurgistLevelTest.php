<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels;

use DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes\ProfessionLevels\AbstractTestOfProfessionLevel;

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
