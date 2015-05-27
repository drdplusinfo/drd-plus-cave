<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels;

use DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes\ProfessionLevels\AbstractTestOfProfessionLevel;

class FighterLevelTest extends AbstractTestOfProfessionLevel
{

    protected function getStrengthFirstLevelModifier()
    {
        return 1;
    }

    protected function getAgilityFirstLevelModifier()
    {
        return 1;
    }

}
