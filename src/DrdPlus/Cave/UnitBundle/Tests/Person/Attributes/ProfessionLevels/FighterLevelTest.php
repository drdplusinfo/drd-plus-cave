<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Tests\Person\Attributes\ProfessionLevels\AbstractTestOfProfessionLevel;

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

    /**
     * @param string $propertyName
     *
     * @return bool
     */
    protected function isPrimaryProperty($propertyName)
    {
        return in_array($propertyName, [Strength::STRENGTH, Agility::AGILITY]);
    }

}
