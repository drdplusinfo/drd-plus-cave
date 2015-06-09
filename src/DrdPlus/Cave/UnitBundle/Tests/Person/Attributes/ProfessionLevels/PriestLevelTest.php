<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Will;
use DrdPlus\Cave\UnitBundle\Tests\Person\Attributes\ProfessionLevels\AbstractTestOfProfessionLevel;

class PriestLevelTest extends AbstractTestOfProfessionLevel
{

    protected function getWillFirstLevelModifier()
    {
        return 1;
    }

    protected function getCharismaFirstLevelModifier()
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
        return in_array($propertyName, [Will::WILL, Charisma::CHARISMA]);
    }


}
