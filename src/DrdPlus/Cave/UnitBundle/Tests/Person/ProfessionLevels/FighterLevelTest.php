<?php
namespace DrdPlus\Cave\UnitBundle\Person\ProfessionLevels;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Tests\Person\ProfessionLevels\AbstractTestOfProfessionLevel;

class FighterLevelTest extends AbstractTestOfProfessionLevel
{

    /**
     * @return string[]
     */
    protected function getPrimaryProperties()
    {
        return [Strength::STRENGTH, Agility::AGILITY];
    }

}
