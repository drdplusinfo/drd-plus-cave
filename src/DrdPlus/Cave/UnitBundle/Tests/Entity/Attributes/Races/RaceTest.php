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
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Exceptions\GenericRaceCanNotBeCreated
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
        $genericRace = Type::getType(Race::getTypeName());
        $this->assertInstanceOf(Race::class, $genericRace);
    }

    /**
     * @test
     * @depends can_be_created_as_enum_type
     */
    public function type_name_of_generic_race_is_as_generic_enum_type()
    {
        $this->assertSame('race', Race::getTypeName());
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
     * @depends subrace_can_be_created
     */
    public function subrace_type_name_is_race_and_subrace_code()
    {
        $raceAndSubraceCode = TestSubrace::getRaceCode() . '-' . TestSubrace::getSubraceCode();
        $this->assertSame($raceAndSubraceCode, TestSubrace::getTypeName());
    }

    /**
     * @test
     * @depends can_be_created_as_enum_type
     */
    public function returns_proper_subrace()
    {
        /** @var Race $genericRace */
        $genericRace = Type::getType(Race::getTypeName());
        $genericRace::addSubTypeEnum(TestSubrace::class, $subTypeRegexp = '~bar~');
        $this->assertRegExp($subTypeRegexp, TestSubrace::getTypeName());
        $subrace = $genericRace->convertToPHPValue(TestSubrace::getTypeName(), $this->getPlatform());
        $this->assertInstanceOf(TestSubrace::class, $subrace);
    }

    /**
     * @test
     * @depends can_be_created_as_enum_type
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Exceptions\MissingSubraceCodeImplementation
     */
    public function missing_subrace_code_cause_exception()
    {
        /** @var Race $genericRace */
        $genericRace = Type::getType(Race::getTypeName());
        $genericRace::addSubTypeEnum(SubraceWithoutSubraceCode::class, '~without_subrace~');
        $genericRace->convertToPHPValue('without_subrace', $this->getPlatform());
    }

    /**
     * @test
     * @depends can_be_created_as_enum_type
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Exceptions\UnexpectedRaceCode
     */
    public function changed_subrace_code_cause_exception()
    {
        /** @var Race $genericRace */
        $genericRace = Type::getType(Race::getTypeName());
        $genericRace::addSubTypeEnum(TestSubraceWithInvalidCode::class, '~baz~');
        TestSubraceWithInvalidCode::returnInvalidCode();
        $genericRace->convertToPHPValue('baz_qux', $this->getPlatform());
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

class TestSubraceWithInvalidCode extends Race
{
    private static $returnInvalidCode = false;

    public static function getRaceCode()
    {
        return 'baz';
    }

    public static function getSubraceCode()
    {
        return 'qux';
    }

    public static function returnInvalidCode()
    {
        self::$returnInvalidCode = true;
    }

    public static function getTypeName()
    {
        return parent::getRaceAndSubraceCode();
    }

    /**
     * @return string
     */
    public static function getRaceAndSubraceCode()
    {
        if (!self::$returnInvalidCode) {
            return parent::getRaceAndSubraceCode();
        }

        return 'some invalid code';
    }

}

class SubraceWithoutSubraceCode extends Race
{

    public static function getRaceCode()
    {
        return 'foo';
    }
}
