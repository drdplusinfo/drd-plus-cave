<?php

namespace DrdPlus\Cave\UnitBundle;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Name;
use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\LevelValue;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Will;
use DrdPlus\Cave\UnitBundle\Person\Races\Gender;
use DrdPlus\Cave\UnitBundle\Person\Races\Race;

class DrdPlusCaveUnitBundleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return DrdPlusCaveUnitBundle
     *
     * @test
     */
    public function can_be_created()
    {
        $instance = new DrdPlusCaveUnitBundle();
        $this->assertNotNull($instance);

        return $instance;
    }

    /**
     * @param DrdPlusCaveUnitBundle $bundle
     *
     * @test
     * @depends can_be_created
     */
    public function register_enums_on_boot(DrdPlusCaveUnitBundle $bundle)
    {
        $bundle->boot();

        $this->assertTrue(Name::isRegistered());
        $this->assertTrue(Race::isRegistered());
        $this->assertTrue(Gender::isRegistered());
        $this->assertTrue(LevelValue::isRegistered());
        $this->assertTrue(Strength::isRegistered());
        $this->assertTrue(Agility::isRegistered());
        $this->assertTrue(Knack::isRegistered());
        $this->assertTrue(Will::isRegistered());
        $this->assertTrue(Intelligence::isRegistered());
        $this->assertTrue(Charisma::isRegistered());
    }
}
