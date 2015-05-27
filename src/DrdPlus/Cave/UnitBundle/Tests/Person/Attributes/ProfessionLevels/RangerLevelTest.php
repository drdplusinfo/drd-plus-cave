<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels;

use DrdPlus\Cave\UnitBundle\Tests\Person\Attributes\ProfessionLevels\AbstractTestOfProfessionLevel;

class RangerLevelTest extends AbstractTestOfProfessionLevel
{

    protected function getStrengthFirstLevelModifier()
    {
        return 1;
    }

    protected function getKnackFirstLevelModifier()
    {
        return 1;
    }

}
