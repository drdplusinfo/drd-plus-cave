<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use DrdPlus\Cave\UnitBundle\Tests\TestWithMockery;

class ExceptionalityTest extends TestWithMockery
{

    /**
     * @test
     */
    public function has_type_name_as_expected()
    {
        $this->assertSame('exceptionality', Exceptionality::getTypeName());
        $this->assertSame('exceptionality', Exceptionality::EXCEPTIONALITY);
    }

    /**
     * @test
     * @depends has_type_name_as_expected
     */
    public function can_register_self()
    {
        Exceptionality::registerSelf();
        $this->assertTrue(Type::hasType(Exceptionality::getTypeName()));
    }

    /**
     * @test
     * @expectedException \LogicException
     */
    public function creating_exceptionality_enum_itself_cause_exception()
    {
        Exceptionality::getEnum('foo');
    }

    /**
     * @test
     * @expectedException \LogicException
     */
    public function creating_exceptionality_enum_by_shortcut_cause_exception()
    {
        Exceptionality::getIt();
    }


    /**
     * @test
     * @depends can_register_self
     */
    public function can_be_created_as_enum_type()
    {
        $genericExceptionality = Type::getType(Exceptionality::getTypeName());
        $this->assertInstanceOf(Exceptionality::class, $genericExceptionality);
    }

    /**
     * @test
     * @depends can_be_created_as_enum_type
     */
    public function type_name_of_generic_race_is_as_generic_enum_type()
    {
        $this->assertSame('exceptionality', Exceptionality::getTypeName());
    }

    /**
     * @test
     * @depends can_register_self
     */
    public function specific_exceptionality_can_be_created()
    {
        TestExceptionality::registerSelf();
        $specificExceptionality = TestExceptionality::getIt();
        $this->assertInstanceOf(TestExceptionality::class, $specificExceptionality);
    }

    /**
     * @test
     * @depends specific_exceptionality_can_be_created
     */
    public function specific_exceptionality_type_name_is_built_from_class_name()
    {
        $this->assertSame('test_exceptionality', TestExceptionality::getTypeName());
    }

    /**
     * @test
     * @depends can_be_created_as_enum_type
     */
    public function returns_proper_specific_exceptionality()
    {
        /** @var Exceptionality $genericExceptionality */
        $genericExceptionality = Type::getType(Exceptionality::getTypeName());
        $genericExceptionality::addSubTypeEnum(TestExceptionality::class, $regexp = '~test_exceptionality~');
        $this->assertRegExp($regexp, TestExceptionality::getTypeName());
        $specificExceptionality = $genericExceptionality->convertToPHPValue(TestExceptionality::getTypeName(), $this->getPlatform());
        $this->assertInstanceOf(TestExceptionality::class, $specificExceptionality);
    }

    /**
     * @test
     * @depends can_be_created_as_enum_type
     * @expectedException \LogicException
     */
    public function changed_subrace_code_cause_exception()
    {
        /** @var Exceptionality $genericRace */
        $genericRace = Type::getType(Exceptionality::getTypeName());
        $genericRace::addSubTypeEnum(TestSubraceWithInvalidKind::class, $regexp = '~test_subrace_with_invalid_kind~');
        $this->assertRegExp($regexp, TestSubraceWithInvalidKind::getTypeName());
        TestSubraceWithInvalidKind::returnInvalidKind();
        $genericRace->convertToPHPValue(TestSubraceWithInvalidKind::getTypeName(), $this->getPlatform());
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
class TestExceptionality extends Exceptionality
{

}

class TestSubraceWithInvalidKind extends Exceptionality
{
    private static $returnInvalidCode = false;

    public static function returnInvalidKind()
    {
        self::$returnInvalidCode = true;
    }

    public static function getKind()
    {
        if (!self::$returnInvalidCode) {
            return parent::getKind();
        }

        return 'some invalid code';
    }

}
