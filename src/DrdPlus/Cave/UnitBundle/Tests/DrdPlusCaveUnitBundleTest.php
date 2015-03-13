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
        $this->assertFalse(Name::isRegistered());
        $this->assertFalse(Race::isRegistered());
        $this->assertFalse(Gender::isRegistered());
        $this->assertFalse(Strength::isRegistered());
        $this->assertFalse(Agility::isRegistered());
        $this->assertFalse(Knack::isRegistered());
        $this->assertFalse(Will::isRegistered());
        $this->assertFalse(Intelligence::isRegistered());
        $this->assertFalse(Charisma::isRegistered());
        $this->assertFalse(LevelValue::isRegistered());

        $bundle->boot();

        $this->assertTrue(Name::isRegistered());
        $this->assertTrue(Race::isRegistered());
        $this->assertTrue(Gender::isRegistered());
        $this->assertTrue(Strength::isRegistered());
        $this->assertTrue(Agility::isRegistered());
        $this->assertTrue(Knack::isRegistered());
        $this->assertTrue(Will::isRegistered());
        $this->assertTrue(Intelligence::isRegistered());
        $this->assertTrue(Charisma::isRegistered());
        $this->assertTrue(LevelValue::isRegistered());
    }
}
