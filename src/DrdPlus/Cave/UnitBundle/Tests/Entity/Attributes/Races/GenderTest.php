<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes\Races\Helpers\SubraceGender;
use DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes\Races\Helpers\SubraceGenderWithAmbiguousGenderDetection;
use DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes\Races\Helpers\SubraceGenderWithInvalidCode;
use DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes\Races\Helpers\SubraceGenderWithUnknownGenderDetection;
use DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes\Races\Helpers\SubraceGenderWithoutFemaleDetection;
use DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes\Races\Helpers\SubraceGenderWithoutMaleDetection;

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
     * @depends can_register_self
     */
    public function subrace_gender_can_be_created()
    {
        SubraceGender::registerSelf();
        $subraceGender = SubraceGender::getIt();
        $this->assertInstanceOf(SubraceGender::class, $subraceGender);
    }

    /**
     * @test
     * @depends subrace_gender_can_be_created
     */
    public function subrace_gender_type_name_is_race_gender_code()
    {
        $raceSubraceAndGenderCode = SubraceGender::getRaceCode() . '-' . SubraceGender::getSubraceCode() . '-' .
            (SubraceGender::isMale()
                ? 'male'
                : 'female');
        $this->assertSame($raceSubraceAndGenderCode, SubraceGender::getTypeName());
    }

    /**
     * @test
     * @depends can_be_created_as_enum_type
     */
    public function gender_returns_proper_subrace_gender()
    {
        /** @var Gender $genericGender */
        $genericGender = Type::getType(Gender::getTypeName());
        $genericGender::addSubTypeEnum(SubraceGender::class, $subTypeRegexp = '~^foo-bar-male$~');
        $this->assertRegExp($subTypeRegexp, SubraceGender::getTypeName());
        $subrace = $genericGender->convertToPHPValue(SubraceGender::getTypeName(), $this->getPlatform());
        $this->assertInstanceOf(SubraceGender::class, $subrace);
    }

    /**
     * @test
     * @depends can_be_created_as_enum_type
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Exceptions\UnexpectedRaceCode
     */
    public function changed_code_throws_exception()
    {
        /** @var Gender $genericGender */
        $genericGender = Type::getType(Gender::getTypeName());
        $genericGender::addSubTypeEnum(SubraceGenderWithInvalidCode::class, '~baz~');
        SubraceGenderWithInvalidCode::returnInvalidCode();
        $genericGender->convertToPHPValue('bar_baz', $this->getPlatform());
    }

    /**
     * @test
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Exceptions\MaleDetectionNotImplemented
     */
    public function missing_male_detection_throws_exception()
    {
        /** @var Gender $genericGender */
        $genericGender = Type::getType(Gender::getTypeName());
        $genericGender::addSubTypeEnum(SubraceGenderWithoutMaleDetection::class, '~male_detection~');
        $genericGender->convertToPHPValue('male_detection', $this->getPlatform());
    }

    /**
     * @test
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Exceptions\FemaleDetectionNotImplemented
     */
    public function missing_female_detection_throws_exception()
    {
        /** @var Gender $genericGender */
        $genericGender = Type::getType(Gender::getTypeName());
        $genericGender::addSubTypeEnum(SubraceGenderWithoutFemaleDetection::class, '~detection_of_female~');
        $genericGender->convertToPHPValue('detection_of_female', $this->getPlatform());
    }

    /**
     * @test
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Exceptions\UnknownGender
     */
    public function unknown_gender_detection_throws_exception()
    {
        /** @var Gender $genericGender */
        $genericGender = Type::getType(Gender::getTypeName());
        $genericGender::addSubTypeEnum(SubraceGenderWithUnknownGenderDetection::class, '~unknown_gender_detection~');
        $genericGender->convertToPHPValue('unknown_gender_detection', $this->getPlatform());
    }

    /**
     * @test
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Exceptions\AmbiguousGender
     */
    public function ambiguous_gender_detection_throws_exception()
    {
        /** @var Gender $genericGender */
        $genericGender = Type::getType(Gender::getTypeName());
        $genericGender::addSubTypeEnum(SubraceGenderWithAmbiguousGenderDetection::class, '~ambiguous_gender_detection~');
        $genericGender->convertToPHPValue('
        ~ambiguous_gender_detection', $this->getPlatform());
    }

    /**
     * @return AbstractPlatform
     */
    protected function getPlatform()
    {
        return \Mockery::mock(AbstractPlatform::class);
    }

}
