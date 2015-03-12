<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races;

class GenderTest extends \PHPUnit_Framework_TestCase
{

    /** @test */
    public function can_register_self_even_as_abstract_class()
    {
        Gender::registerSelf();
        $this->assertTrue(Gender::hasType(Gender::getTypeName()));
    }

    /** @test */
    public function has_type_name_as_expected()
    {
        $this->assertSame('gender', Gender::getTypeName());
        $this->assertSame(Gender::TYPE_GENDER, Gender::getTypeName());
    }

    /**
     * @test
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Exceptions\AbstractRaceCanNotBeCreated
     */
    public function creating_abstract_gender_enum_cause_exception()
    {
        Gender::getEnum('foo');
    }

    /**
     * @test
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Exceptions\MissingRaceCodeImplementation
     */
    public function creating_abstract_gender_enum_by_shortcut_cause_exception()
    {
        Gender::getIt();
    }

    /**
     * @test
     */
    public function can_use_subrace_gender()
    {
        Gender::addSubTypeEnum(TestSubraceGender::class, $regexp = '~' . TestSubraceGender::getRaceCode() . '~');
        $raceSubraceAndGenderCode = TestSubraceGender::getRaceSubraceAndGenderCode();
        $this->assertRegExp($regexp, $raceSubraceAndGenderCode);
        $subrace = Gender::getGender($raceSubraceAndGenderCode);
        $this->assertInstanceOf(TestSubraceGender::class, $subrace);
        $this->assertSame($raceSubraceAndGenderCode, (string)$subrace);
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
    public static function isMale() {
        return true;
    }

    /**
     * @return bool
     */
    public static function isFemale() {
        return false;
    }

}
