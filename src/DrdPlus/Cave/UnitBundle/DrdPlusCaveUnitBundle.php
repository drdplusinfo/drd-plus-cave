<?php

namespace DrdPlus\Cave\UnitBundle;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Name;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\LevelValue;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Will;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Gender;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Race;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DrdPlusCaveUnitBundle extends Bundle
{
    public function boot()
    {
        $this->registerEnums();
    }

    private function registerEnums()
    {
        Name::registerSelf();

        Race::registerSelf();
        Gender::registerSelf();

        // TODO register genders

        Strength::registerSelf();
        Agility::registerSelf();
        Knack::registerSelf();
        Will::registerSelf();
        Intelligence::registerSelf();
        Charisma::registerSelf();

        LevelValue::registerSelf();
    }
}
