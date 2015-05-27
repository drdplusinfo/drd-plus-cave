<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels;

use DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes\ProfessionLevels\AbstractTestOfProfessionLevel;

class ThiefLevelTest extends AbstractTestOfProfessionLevel
{

    protected function getAgilityFirstLevelModifier()
    {
        return 1;
    }

    protected function getKnackFirstLevelModifier()
    {
        return 1;
    }

}
