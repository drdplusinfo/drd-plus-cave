<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class RaceTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function has_type_name_as_expected()
    {
        $this->assertSame('race', Race::getTypeName());
        $this->assertSame(Race::TYPE_RACE, Race::getTypeName());
    }

    /**
     * @test
     * @depends has_type_name_as_expected
     */
    public function can_register_self()
    {
        Race::registerSelf();
        $this->assertTrue(Race::hasType(Race::getTypeName()));
    }

    /**
     * @test
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Exceptions\AbstractRaceCanNotBeCreated
     */
    public function creating_race_enum_itself_cause_exception()
    {
        Race::getEnum('foo');
    }

    /**
     * @test
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Exceptions\MissingRaceCodeImplementation
     */
    public function creating_race_enum_by_shortcut_cause_exception()
    {
        Race::getIt();
    }


    /**
     * @test
     * @depends can_register_self
     */
    public function can_be_created_as_enum_type()
    {
        $race = Type::getType(Race::getTypeName());
        $this->assertInstanceOf(Race::class, $race);
    }

    /**
     * @test
     * @depends can_register_self
     */
    public function subrace_can_be_created()
    {
        TestSubrace::registerSelf();
        $subrace = TestSubrace::getIt();
        $this->assertInstanceOf(TestSubrace::class, $subrace);
    }

    /**
     * @test
     * @depends can_register_self
     */
    public function race_returns_proper_subrace()
    {
        /** @var Race $genericRace */
        $genericRace = Type::getType(Race::getTypeName());
        $genericRace::addSubTypeEnum(TestSubrace::class, $subTypeRegexp = '~bar~');
        $this->assertRegExp($subTypeRegexp, TestSubrace::getTypeName());
        $subrace = $genericRace->convertToPHPValue(TestSubrace::getTypeName(), $this->getPlatform());
        $this->assertInstanceOf(TestSubrace::class, $subrace);
    }

    /**
     * @return AbstractPlatform
     */
    protected function getPlatform()
    {
        return \Mockery::mock(AbstractPlatform::class);
    }

}

/** inner */
class TestSubrace extends Race
{

    public static function getRaceCode()
    {
        return 'foo';
    }

    public static function getSubraceCode()
    {
        return 'bar';
    }
}
