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
use Granam\Tests\Tools\TestWithMockery;

class DrdPlusCaveUnitBundleTest extends TestWithMockery
{
    /**
     * @return DrdPlusCaveUnitBundle
     *
     * @test
     */
    public function I_can_create_it()
    {
        $instance = new DrdPlusCaveUnitBundle();
        self::assertNotNull($instance);

        return $instance;
    }

    /**
     * @param DrdPlusCaveUnitBundle $bundle
     *
     * @test
     * @depends I_can_create_it
     */
    public function I_can_use_enums_without_explicit_regitering(DrdPlusCaveUnitBundle $bundle)
    {
        $bundle->boot();

        self::assertTrue(NameType::isRegistered());
        self::assertTrue(RaceType::isRegistered());
        self::assertTrue(GenderType::isRegistered());
        self::assertTrue(LevelRankType::isRegistered());
        self::assertTrue(StrengthType::isRegistered());
        self::assertTrue(AgilityType::isRegistered());
        self::assertTrue(KnackType::isRegistered());
        self::assertTrue(WillType::isRegistered());
        self::assertTrue(IntelligenceType::isRegistered());
        self::assertTrue(CharismaType::isRegistered());
    }
}
