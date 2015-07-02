<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Person\Attributes\Properties;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Doctrineum\Integer\IntegerEnum;
use Doctrineum\Integer\SelfTypedIntegerEnum;
use Doctrineum\Scalar\EnumInterface;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Parts\BaseProperty;
use DrdPlus\Cave\UnitBundle\Tests\TestWithMockery;

abstract class AbstractTestOfProperty extends TestWithMockery
{

    /**
     * @test
     */
    public function type_is_as_expected()
    {
        $propertyClass = $this->getPropertyClass();
        $propertyName = $this->getPropertyName();
        $constantName = strtoupper($propertyName);
        $this->assertTrue(defined("$propertyClass::$constantName"));
        $this->assertSame($propertyName, constant("$propertyClass::$constantName"));
        $this->assertSame($propertyName, $propertyClass::getTypeName());
    }

    /**
     * @return string|BaseProperty
     */
    private function getPropertyClass()
    {
        return preg_replace('~Test$~', '', static::class);
    }

    /**
     * @return string
     */
    private function getPropertyName()
    {
        $propertyBaseName = $this->getPropertyBaseName();
        $underScoredClassName = preg_replace('~(\w)([A-Z])~', '$1_$2', $propertyBaseName);

        return strtolower($underScoredClassName);
    }

    /**
     * @return string
     */
    private function getPropertyBaseName()
    {
        $propertyClass = $this->getPropertyClass();

        return preg_replace('~(\w+\\\)*(\w+)~', '$2', $propertyClass);
    }

    /**
     * @test
     * @depends type_is_as_expected
     */
    public function can_be_registered()
    {
        $propertyClass = $this->getPropertyClass();
        $propertyClass::registerSelf();
        $this->assertTrue(Type::hasType($propertyClass::getTypeName()));
    }

    /**
     * @return BaseProperty
     *
     * @test
     * @depends can_be_registered
     */
    public function can_be_created()
    {
        $propertyClass = $this->getPropertyClass();
        $instance = $propertyClass::getEnum(12345);
        $this->assertInstanceOf($propertyClass, $instance);

        return $instance;
    }

    /**
     * @param BaseProperty $property
     *
     * @test
     * @depends can_be_created
     */
    public function is_a_doctrineum_enum(BaseProperty $property)
    {
        $this->assertInstanceOf(EnumInterface::class, $property);
    }

    /**
     * @param BaseProperty $property
     *
     * @test
     * @depends can_be_created
     */
    public function is_an_doctrineum_self_typed_integer_enum(BaseProperty $property)
    {
        $this->assertInstanceOf(SelfTypedIntegerEnum::class, $property);
    }

    /**
     * @test
     * @depends can_be_registered
     */
    public function works_in_separate_enum_namespace()
    {
        $propertyClass = $this->getPropertyClass();
        $name = $propertyClass::getEnum($value = 12345);
        $integerEnum = IntegerEnum::getEnum($value);
        $this->assertNotSame($name, $integerEnum);
        $this->assertSame((string)$name, (string)$integerEnum);
        SelfTypedIntegerEnum::registerSelf();
        $selfTypedIntegerEnum = SelfTypedIntegerEnum::getEnum($value);
        $this->assertNotSame($name, $selfTypedIntegerEnum);
        $this->assertSame((string)$name, (string)$selfTypedIntegerEnum);
    }

    /**
     * @param BaseProperty $property
     *
     * @test
     * @depends can_be_created
     */
    public function conversion_to_php_gives_property(BaseProperty $property)
    {
        $platform = \Mockery::mock(AbstractPlatform::class);
        /** @var AbstractPlatform $platform */
        $phpValue = $property->convertToPHPValue($value = 12345, $platform);
        $this->assertInstanceOf($this->getPropertyClass(), $phpValue);
        $this->assertEquals($value, $phpValue->__toString());
    }

    /**
     * @test
     * @depends can_be_created
     */
    public function can_give_value_by_shortcut_getter()
    {
        $propertyClass = $this->getPropertyClass();
        /** @var BaseProperty $property */
        $property = $propertyClass::getEnum($value = 123);
        $this->assertSame($value, $property->getValue());
    }
}
