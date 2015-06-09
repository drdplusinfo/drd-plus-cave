<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Strength;
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

    /**
     * @param string $propertyName
     *
     * @return bool
     */
    protected function isPrimaryProperty($propertyName)
    {
        return in_array($propertyName, [Strength::STRENGTH, Knack::KNACK]);
    }


}
