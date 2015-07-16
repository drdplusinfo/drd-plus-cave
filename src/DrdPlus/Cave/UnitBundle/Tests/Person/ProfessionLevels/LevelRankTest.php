<?php
namespace DrdPlus\Cave\UnitBundle\Person\ProfessionLevels;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Doctrineum\Integer\IntegerEnum;
use Doctrineum\Integer\SelfTypedIntegerEnum;
use Doctrineum\Scalar\EnumInterface;
use DrdPlus\Cave\UnitBundle\Tests\TestWithMockery;

class LevelRankTest extends TestWithMockery
{
    /**
     * @test
     */
    public function type_is_as_expected()
    {
        $this->assertSame('level_rank', LevelRank::LEVEL_RANK);
        $this->assertSame('level_rank', LevelRank::getTypeName());
    }

    /**
     * @test
     * @depends type_is_as_expected
     */
    public function can_be_registered()
    {
        LevelRank::registerSelf();
        $this->assertTrue(Type::hasType(LevelRank::getTypeName()));
    }

    /**
     * @return LevelRank
     *
     * @test
     * @depends can_be_registered
     */
    public function can_be_created()
    {
        $instance = LevelRank::getEnum($value = 12345);
        $this->assertInstanceOf(LevelRank::class, $instance);
        $this->assertSame($value, $instance->getEnumValue());
        $sameInstance = LevelRank::getIt($value);
        $this->assertSame($instance, $sameInstance);
        $differentInstance = LevelRank::getIt($value + 1);
        $this->assertInstanceOf(LevelRank::class, $instance);
        $this->assertNotSame($instance, $differentInstance);

        return $instance;
    }

    /**
     * @param LevelRank $levelRank
     *
     * @test
     * @depends can_be_created
     */
    public function is_a_doctrineum_enum(LevelRank $levelRank)
    {
        $this->assertInstanceOf(EnumInterface::class, $levelRank);
    }

    /**
     * @param LevelRank $levelRank
     *
     * @test
     * @depends can_be_created
     */
    public function is_an_doctrineum_self_typed_integer_enum(LevelRank $levelRank)
    {
        $this->assertInstanceOf(SelfTypedIntegerEnum::class, $levelRank);
    }

    /**
     * @test
     * @depends can_be_registered
     */
    public function works_in_separate_enum_namespace()
    {
        $levelRank = LevelRank::getEnum($value = 12345);
        $integerEnum = IntegerEnum::getEnum($value);
        $this->assertNotSame($levelRank, $integerEnum);
        $this->assertSame((string)$levelRank, (string)$integerEnum);
        SelfTypedIntegerEnum::registerSelf();
        $selfTypedIntegerEnum = SelfTypedIntegerEnum::getEnum($value);
        $this->assertNotSame($levelRank, $selfTypedIntegerEnum);
        $this->assertSame((string)$levelRank, (string)$selfTypedIntegerEnum);
    }

    /**
     * @param LevelRank $levelRank
     *
     * @test
     * @depends can_be_created
     */
    public function conversion_to_php_gives_property(LevelRank $levelRank)
    {
        $platform = \Mockery::mock(AbstractPlatform::class);
        /** @var AbstractPlatform $platform */
        $phpValue = $levelRank->convertToPHPValue($value = 12345, $platform);
        $this->assertInstanceOf(LevelRank::class, $phpValue);
        $this->assertEquals($value, $phpValue->__toString());
    }

    /**
     * @test
     *
     * @depends works_in_separate_enum_namespace
     */
    public function gives_proper_value(){
        $levelRank = LevelRank::getEnum($value = 12345);
        $this->assertSame($value, $levelRank->getEnumValue());
        $this->assertSame($value, $levelRank->getValue());
        $this->assertSame("$value", $levelRank->__toString());
    }
}
