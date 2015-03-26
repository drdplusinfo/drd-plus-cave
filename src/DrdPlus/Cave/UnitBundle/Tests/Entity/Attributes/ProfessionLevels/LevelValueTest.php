<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Doctrineum\Integer\IntegerEnum;
use Doctrineum\Integer\SelfTypedIntegerEnum;
use Doctrineum\Scalar\EnumInterface;

class LevelValueTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function type_is_as_expected()
    {
        $this->assertSame('level_value', LevelValue::LEVEL_VALUE);
        $this->assertSame('level_value', LevelValue::getTypeName());
    }

    /**
     * @test
     * @depends type_is_as_expected
     */
    public function can_be_registered()
    {
        LevelValue::registerSelf();
        $this->assertTrue(Type::hasType(LevelValue::getTypeName()));
    }

    /**
     * @return LevelValue
     *
     * @test
     * @depends can_be_registered
     */
    public function can_be_created()
    {
        $instance = LevelValue::getEnum($value = 12345);
        $this->assertInstanceOf(LevelValue::class, $instance);
        $this->assertSame($value, $instance->getEnumValue());
        $sameInstance = LevelValue::getIt($value);
        $this->assertSame($instance, $sameInstance);
        $differentInstance = LevelValue::getIt($value + 1);
        $this->assertInstanceOf(LevelValue::class, $instance);
        $this->assertNotSame($instance, $differentInstance);

        return $instance;
    }

    /**
     * @param LevelValue $levelValue
     *
     * @test
     * @depends can_be_created
     */
    public function is_a_doctrineum_enum(LevelValue $levelValue)
    {
        $this->assertInstanceOf(EnumInterface::class, $levelValue);
    }

    /**
     * @param LevelValue $levelValue
     *
     * @test
     * @depends can_be_created
     */
    public function is_an_doctrineum_self_typed_integer_enum(LevelValue $levelValue)
    {
        $this->assertInstanceOf(SelfTypedIntegerEnum::class, $levelValue);
    }

    /**
     * @test
     * @depends can_be_registered
     */
    public function works_in_separate_enum_namespace()
    {
        $levelValue = LevelValue::getEnum($value = 12345);
        $integerEnum = IntegerEnum::getEnum($value);
        $this->assertNotSame($levelValue, $integerEnum);
        $this->assertSame((string)$levelValue, (string)$integerEnum);
        SelfTypedIntegerEnum::registerSelf();
        $selfTypedIntegerEnum = SelfTypedIntegerEnum::getEnum($value);
        $this->assertNotSame($levelValue, $selfTypedIntegerEnum);
        $this->assertSame((string)$levelValue, (string)$selfTypedIntegerEnum);
    }

    /**
     * @param LevelValue $levelValue
     *
     * @test
     * @depends can_be_created
     */
    public function conversion_to_php_gives_property(Levelvalue $levelValue)
    {
        $platform = \Mockery::mock(AbstractPlatform::class);
        /** @var AbstractPlatform $platform */
        $phpValue = $levelValue->convertToPHPValue($value = 12345, $platform);
        $this->assertInstanceOf(Levelvalue::class, $phpValue);
        $this->assertEquals($value, $phpValue->__toString());
    }

    /**
     * @test
     *
     * @depends works_in_separate_enum_namespace
     */
    public function gives_proper_value(){
        $levelValue = LevelValue::getEnum($value = 12345);
        $this->assertSame($value, $levelValue->getEnumValue());
        $this->assertSame($value, $levelValue->getRank());
        $this->assertSame("$value", $levelValue->__toString());
    }
}
