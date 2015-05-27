<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels;

use DrdPlus\Cave\UnitBundle\Tests\Person\Attributes\ProfessionLevels\AbstractTestOfProfessionLevel;

class WizardLevelTest extends AbstractTestOfProfessionLevel
{

    protected function getIntelligenceFirstLevelModifier()
    {
        return 1;
    }

    protected function getWillFirstLevelModifier()
    {
        return 1;
    }

}
