<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class GenderTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function can_register_self()
    {
        Gender::registerSelf();
        $this->assertTrue(Gender::hasType(Gender::getTypeName()));
    }

    /**
     * @test
     * */
    public function has_type_name_as_expected()
    {
        $this->assertSame('gender', Gender::getTypeName());
        $this->assertSame(Gender::TYPE_GENDER, Gender::getTypeName());
    }

    /**
     * @test
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Exceptions\GenericRaceCanNotBeCreated
     */
    public function creating_gender_enum_itself_cause_exception()
    {
        Gender::getEnum('foo');
    }

    /**
     * @test
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Exceptions\MissingRaceCodeImplementation
     */
    public function creating_gender_enum_itself_by_shortcut_cause_exception()
    {
        Gender::getIt();
    }

    /**
     * @test
     * @depends can_register_self
     */
    public function can_be_created_as_enum_type()
    {
        $genericGender = Type::getType(Gender::getTypeName());
        $this->assertInstanceOf(Gender::class, $genericGender);
    }

    /**
     * @test
     * @depends can_be_created_as_enum_type
     */
    public function type_name_of_generic_gender_is_as_generic_enum_type()
    {
        $this->assertSame('gender', Gender::getTypeName());
    }

    /**
     * @test
     * @depends can_register_self
     */
    public function subrace_gender_can_be_created()
    {
        TestSubraceGender::registerSelf();
        $subraceGender = TestSubraceGender::getIt();
        $this->assertInstanceOf(TestSubraceGender::class, $subraceGender);
    }

    /**
     * @test
     * @depends subrace_gender_can_be_created
     */
    public function subrace_gender_type_name_is_race_gender_code()
    {
        $raceSubraceAndGenderCode = TestSubraceGender::getRaceCode() . '-' . TestSubraceGender::getSubraceCode() . '-' .
            (TestSubraceGender::isMale()
                ? 'male'
                : 'female');
        $this->assertSame($raceSubraceAndGenderCode, TestSubraceGender::getTypeName());
    }

    /**
     * @test
     * @depends can_be_created_as_enum_type
     */
    public function gender_returns_proper_subrace_gender()
    {
        /** @var Gender $genericGender */
        $genericGender = Type::getType(Gender::getTypeName());
        $genericGender::addSubTypeEnum(TestSubraceGender::class, $subTypeRegexp = '~^foo-bar-male$~');
        $this->assertRegExp($subTypeRegexp, TestSubraceGender::getTypeName());
        $subrace = $genericGender->convertToPHPValue(TestSubraceGender::getTypeName(), $this->getPlatform());
        $this->assertInstanceOf(TestSubraceGender::class, $subrace);
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
class TestSubraceGender extends Gender
{
    /**
     * @return string
     */
    public static function getRaceCode()
    {
        return 'foo';
    }

    /**
     * @return string
     */
    public static function getSubraceCode()
    {
        return 'bar';
    }

    /**
     * @return bool
     */
    public static function isMale()
    {
        return true;
    }

    /**
     * @return bool
     */
    public static function isFemale()
    {
        return false;
    }

}
