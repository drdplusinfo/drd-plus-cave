<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Will;
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

    /**
     * @param string $propertyName
     *
     * @return bool
     */
    protected function isPrimaryProperty($propertyName)
    {
        return in_array($propertyName, [Will::WILL, Intelligence::INTELLIGENCE]);
    }

}
