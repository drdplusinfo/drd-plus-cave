<?php

namespace DrdPlus\Cave\UnitBundle;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\NameEnumType;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\AgilityEnumType;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\CharismaEnumType;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\IntelligenceEnumType;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\KnackEnumType;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\StrengthEnumType;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\WillEnumType;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\RaceEnumType;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Doctrine\DBAL\Types\Type;
use \DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\GenderEnumType;

class DrdPlusCaveUnitBundle extends Bundle
{
    public function boot()
    {
        Type::addType(RaceEnumType::TYPE, RaceEnumType::class);
        Type::addType(GenderEnumType::TYPE, GenderEnumType::class);

        Type::addType(NameEnumType::TYPE, NameEnumType::class);

        Type::addType(StrengthEnumType::TYPE, StrengthEnumType::class);
        Type::addType(AgilityEnumType::TYPE, AgilityEnumType::class);
        Type::addType(KnackEnumType::TYPE, KnackEnumType::class);
        Type::addType(WillEnumType::TYPE, WillEnumType::class);
        Type::addType(IntelligenceEnumType::TYPE, IntelligenceEnumType::class);
        Type::addType(CharismaEnumType::TYPE, CharismaEnumType::class);
    }
}
