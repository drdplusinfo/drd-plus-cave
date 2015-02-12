<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes;

use Doctrineum\Enum;
use Doctrineum\StrictString\StrictStringEnum;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Name;

class NameTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function can_be_created()
    {
        $instance = Name::get('foo');
        $this->assertInstanceOf(Name::class, $instance);
    }

    /** @test */
    public function is_an_doctrineum_enum()
    {
        $instance = Name::get('foo');
        $this->assertInstanceOf(Enum::class, $instance);
    }

    /** @test */
    public function is_an_doctrineum_strict_string_enum()
    {
        $instance = Name::get('foo');
        $this->assertInstanceOf(StrictStringEnum::class, $instance);
    }

    /** @test */
    public function works_in_separate_enum_namespace()
    {
        $name = Name::get($string = 'foo');
        $strictStringEnum = StrictStringEnum::get($string);
        $this->assertNotSame($name, $strictStringEnum);
        $this->assertSame((string)$name, (string)$strictStringEnum);
    }

    /** @test */
    public function recognizes_if_is_empty()
    {
        $emptyName = Name::get('');
        $this->assertTrue($emptyName->isEmpty());
        $filledName = Name::get('foo');
        $this->assertFalse($filledName->isEmpty());
    }
}
