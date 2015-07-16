<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Doctrineum\Scalar\EnumInterface;
use Doctrineum\Strict\String\SelfTypedStrictStringEnum;
use Doctrineum\Strict\String\StrictStringEnum;
use DrdPlus\Cave\UnitBundle\Tests\TestWithMockery;

class NameTest extends TestWithMockery
{

    /**
     * @test
     */
    public function can_be_registered()
    {
        Name::registerSelf();
        $this->assertTrue(Type::hasType(Name::getTypeName()));
    }

    /**
     * @return Name
     *
     * @test
     * @depends can_be_registered
     */
    public function can_be_created()
    {
        $instance = Name::getEnum($value = 'foo');
        $this->assertInstanceOf(Name::class, $instance);
        $this->assertSame($value, $instance->getValue());
        $sameInstance = Name::getIt($value);
        $this->assertSame($sameInstance, $instance);
        $differentInstance = Name::getIt('bar');
        $this->assertInstanceOf(Name::class, $differentInstance);
        $this->assertNotSame($instance, $differentInstance);

        return $instance;
    }

    /**
     * @param Name $name
     *
     * @test
     * @depends can_be_created
     */
    public function is_a_doctrineum_enum(Name $name)
    {
        $this->assertInstanceOf(EnumInterface::class, $name);
    }

    /**
     * @param Name $name
     *
     * @test
     * @depends can_be_created
     */
    public function is_an_doctrineum_self_typed_strict_string_enum(Name $name)
    {
        $this->assertInstanceOf(SelfTypedStrictStringEnum::class, $name);
    }

    /**
     * @return Name
     *
     * @test
     * @depends can_be_registered
     */
    public function works_in_separate_enum_namespace()
    {
        $name = Name::getEnum($string = 'foo');
        $strictStringEnum = StrictStringEnum::getEnum($string);
        $this->assertNotSame($name, $strictStringEnum);
        $this->assertSame((string)$name, (string)$strictStringEnum);
    }

    /**
     * @return Name
     *
     * @test
     * @depends can_be_registered
     */
    public function recognizes_if_is_empty()
    {
        $emptyName = Name::getEnum('');
        $this->assertTrue($emptyName->isEmpty());
        $filledName = Name::getEnum('foo');
        $this->assertFalse($filledName->isEmpty());
    }

    /**
     * @return Name
     *
     * @test
     * @depends can_be_registered
     */
    public function conversion_to_php_gives_name()
    {
        Name::addType('foo', Name::class);
        $enumType = Name::getType('foo');
        $this->assertInstanceOf(Name::class, $enumType);

        $platform = \Mockery::mock(AbstractPlatform::class);
        /** @var AbstractPlatform $platform */
        $phpValue = $enumType->convertToPHPValue('bar', $platform);
        $this->assertInstanceOf(Name::class, $phpValue);
    }

    /**
     * @test
     * @depends can_be_registered
     */
    public function can_return_name_value_by_shortcut_getter()
    {
        $filledName = Name::getEnum($value = 'foo');
        $this->assertSame($value, $filledName->getValue());
    }
}
