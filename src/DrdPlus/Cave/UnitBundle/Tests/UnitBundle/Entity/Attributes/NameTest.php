<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Doctrineum\Generic\Enum;
use Doctrineum\Generic\EnumInterface;
use Doctrineum\Strict\String\SelfTypedStrictStringEnum;
use Doctrineum\Strict\String\StrictStringEnum;

class NameTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        if (Type::hasType(Name::getTypeName())) {
            Type::overrideType(Name::getTypeName(), Name::class);
        } else {
            Name::registerSelf();
        }
    }

    /** @test */
    public function can_be_created()
    {
        $instance = Name::getEnum('foo');
        $this->assertInstanceOf(Name::class, $instance);
    }

    /** @test */
    public function is_an_doctrineum_enum()
    {
        $instance = Name::getEnum('foo');
        $this->assertInstanceOf(EnumInterface::class, $instance);
    }

    /** @test */
    public function is_an_doctrineum_self_typed_strict_string_enum()
    {
        $instance = Name::getEnum('foo');
        $this->assertInstanceOf(SelfTypedStrictStringEnum::class, $instance);
    }

    /** @test */
    public function works_in_separate_enum_namespace()
    {
        $name = Name::getEnum($string = 'foo');
        $strictStringEnum = StrictStringEnum::getEnum($string);
        $this->assertNotSame($name, $strictStringEnum);
        $this->assertSame((string)$name, (string)$strictStringEnum);
    }

    /** @test */
    public function recognizes_if_is_empty()
    {
        $emptyName = Name::getEnum('');
        $this->assertTrue($emptyName->isEmpty());
        $filledName = Name::getEnum('foo');
        $this->assertFalse($filledName->isEmpty());
    }

    /** @test */
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
}
