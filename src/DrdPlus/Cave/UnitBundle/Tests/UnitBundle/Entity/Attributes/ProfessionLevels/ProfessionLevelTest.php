<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Will;

class ProfessionLevelTest extends \PHPUnit_Framework_TestCase
{

    /** @test */
    public function can_create_instance()
    {
        /** @var LevelValue $levelValue */
        $levelValue = \Mockery::mock(LevelValue::class);
        /** @var Strength $strengthIncrement */
        $strengthIncrement = \Mockery::mock(Strength::class);
        /** @var Agility $agilityIncrement */
        $agilityIncrement = \Mockery::mock(Agility::class);
        /** @var Knack $knackIncrement */
        $knackIncrement = \Mockery::mock(Knack::class);
        /** @var Intelligence $intelligenceIncrement */
        $intelligenceIncrement = \Mockery::mock(Intelligence::class);
        /** @var Charisma $charismaIncrement */
        $charismaIncrement = \Mockery::mock(Charisma::class);
        /** @var Will $willIncrement */
        $willIncrement = \Mockery::mock(Will::class);
        $instance = new TestProfessionLevel(
            $levelValue,
            $strengthIncrement,
            $agilityIncrement,
            $knackIncrement,
            $intelligenceIncrement,
            $charismaIncrement,
            $willIncrement
        );
        $this->assertInstanceOf(ProfessionLevel::class, $instance);
    }
}

/** inner */
class TestProfessionLevel extends ProfessionLevel {

    /**
     * @return string[]
     */
    public function getMainPropertyCodes()
    {
        return ['foo', 'bar'];
    }

    /**
     * @return string
     */
    public function getProfessionCode()
    {
        return 'baz';
    }

}
