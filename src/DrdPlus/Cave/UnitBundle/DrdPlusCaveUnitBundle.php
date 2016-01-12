<?php
namespace DrdPlus\Cave\UnitBundle;

use Drd\Genders\EnumTypes\GenderType;
use DrdPlus\Person\Attributes\EnumTypes\NameType;
use DrdPlus\Person\ProfessionLevels\EnumTypes\LevelRankType;
use DrdPlus\Properties\Base\EnumTypes\AgilityType;
use DrdPlus\Properties\Base\EnumTypes\CharismaType;
use DrdPlus\Properties\Base\EnumTypes\IntelligenceType;
use DrdPlus\Properties\Base\EnumTypes\KnackType;
use DrdPlus\Properties\Base\EnumTypes\StrengthType;
use DrdPlus\Properties\Base\EnumTypes\WillType;
use DrdPlus\Races\EnumTypes\RaceType;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DrdPlusCaveUnitBundle extends Bundle
{
    public function boot()
    {
        $this->registerEnums();
    }

    private function registerEnums()
    {
        NameType::registerSelf();
        RaceType::registerSelf();
        GenderType::registerSelf();
        LevelRankType::registerSelf();
        StrengthType::registerSelf();
        AgilityType::registerSelf();
        KnackType::registerSelf();
        WillType::registerSelf();
        IntelligenceType::registerSelf();
        CharismaType::registerSelf();
    }
}
