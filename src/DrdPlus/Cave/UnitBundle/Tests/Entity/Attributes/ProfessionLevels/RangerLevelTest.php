<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels;

use DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes\ProfessionLevels\AbstractTestOfProfessionLevel;

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
