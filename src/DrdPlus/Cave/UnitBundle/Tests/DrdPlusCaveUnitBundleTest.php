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
use DrdPlus\Tests\Tools\TestWithMockery;

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
        $this->assertNotNull($instance);

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

        $this->assertTrue(NameType::isRegistered());
        $this->assertTrue(RaceType::isRegistered());
        $this->assertTrue(GenderType::isRegistered());
        $this->assertTrue(LevelRankType::isRegistered());
        $this->assertTrue(StrengthType::isRegistered());
        $this->assertTrue(AgilityType::isRegistered());
        $this->assertTrue(KnackType::isRegistered());
        $this->assertTrue(WillType::isRegistered());
        $this->assertTrue(IntelligenceType::isRegistered());
        $this->assertTrue(CharismaType::isRegistered());
    }
}
