<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes\Exceptionalities;

use Doctrine\DBAL\Types\Type;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities\Exceptionality;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Race;
use DrdPlus\Cave\UnitBundle\Tests\TestWithMockery;

abstract class AbstractTestOfExceptionality extends TestWithMockery
{
    /**
     * @test
     */
    public function type_name_is_as_expected()
    {
        $raceClass = $this->getExceptionalityClass();
        $this->assertSame($this->buildExceptionalityName(), $raceClass::getTypeName());
    }

    /**
     * @return string
     */
    protected function buildExceptionalityName()
    {
        $baseName = $this->getExceptionalityBaseName();
        $underScoredBaseName = preg_replace('~(\w)([A-Z])~', '$1_$2', $baseName);

        return strtolower($underScoredBaseName);
    }

    /**
     * @return string
     */
    protected function getExceptionalityBaseName()
    {
        $subraceClass = $this->getExceptionalityClass();

        return preg_replace('~(\w+\\\)*(\w+)~', '$2', $subraceClass);
    }

    /**
     * @return string|Exceptionality
     */
    protected function getExceptionalityClass()
    {
        return preg_replace('~Test$~', '', static::class);
    }

    /**
     * @test
     */
    public function can_register_self()
    {
        $exceptionalityClass = $this->getExceptionalityClass();
        $exceptionalityClass::registerSelf();
        $this->assertTrue(Type::hasType($exceptionalityClass::getTypeName()));
    }

    /**
     * @return Race
     *
     * @test
     * @depends can_register_self
     */
    public function can_create_self()
    {
        $exceptionalityClass = $this->getExceptionalityClass();
        $instance = $exceptionalityClass::getIt();
        $this->assertInstanceOf($exceptionalityClass, $instance);
        $expectedName = $this->buildExceptionalityName();
        $this->assertSame($expectedName, $instance->getTypeName());
        // as a self-typed single-value enum is the type name same as the enum value
        $this->assertSame($expectedName, $instance->getEnumValue());
        // kind is human shortcut for enum value
        $this->assertSame($expectedName, $instance->getKind());

        return $instance;
    }
}
