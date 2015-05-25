<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes\Exceptionalities\Kinds;

use Doctrine\DBAL\Types\Type;
use DrdPlus\Cave\ToolsBundle\Dices\Roll;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities\Kinds\AbstractKind;
use DrdPlus\Cave\UnitBundle\Tests\TestWithMockery;

abstract class AbstractTestOfKind extends TestWithMockery
{
    /**
     * @test
     */
    public function type_name_is_as_expected()
    {
        $raceClass = $this->getKindClass();
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
        $subraceClass = $this->getKindClass();

        return preg_replace('~(\w+\\\)*(\w+)~', '$2', $subraceClass);
    }

    /**
     * @return string|AbstractKind
     */
    protected function getKindClass()
    {
        return preg_replace('~Test$~', '', static::class);
    }

    /**
     * @test
     */
    public function can_register_self()
    {
        $exceptionalityClass = $this->getKindClass();
        $exceptionalityClass::registerSelf();
        $this->assertTrue(Type::hasType($exceptionalityClass::getTypeName()));
    }

    /**
     * @return AbstractKind
     *
     * @test
     * @depends can_register_self
     */
    public function can_create_self()
    {
        $exceptionalityClass = $this->getKindClass();
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

    /**
     * @param AbstractKind $kind
     *
     * @test
     * @depends can_create_self
     */
    public function gives_expected_primary_properties_bonus_on_conservative(AbstractKind $kind)
    {
        $this->assertSame($this->getExpectedPrimaryPropertiesBonusOnConservative(), $kind->getPrimaryPropertiesBonusOnConservative());
    }

    /**
     * @return int
     */
    abstract protected function getExpectedPrimaryPropertiesBonusOnConservative();

    /**
     * @param AbstractKind $kind
     *
     * @test
     * @depends can_create_self
     */
    public function gives_expected_secondary_properties_bonus_on_conservative(AbstractKind $kind)
    {
        $this->assertSame($this->getExpectedSecondaryPropertiesBonusOnConservative(), $kind->getSecondaryPropertiesBonusOnConservative());
    }

    /**
     * @return int
     */
    abstract protected function getExpectedSecondaryPropertiesBonusOnConservative();

    /**
     * @param AbstractKind $kind
     *
     * @test
     * @depends can_create_self
     */
    public function gives_expected_primary_properties_bonus_on_fortune(AbstractKind $kind)
    {
        foreach ([1, 2, 3, 4, 5, 6] as $value) {
            $roll = $this->mockery(Roll::class);
            $roll->shouldReceive('getRollSummary')
                ->andReturn($value);
            /** @var Roll $roll */
            $this->assertSame(
                $this->getExpectedPrimaryPropertiesBonusOnFortune($value),
                $kind->getPrimaryPropertiesBonusOnFortune($roll),
                "Value of $value should result to bonus {$this->getExpectedSecondaryPropertiesBonusOnFortune($value)}, but resulted into {$kind->getSecondaryPropertiesBonusOnFortune($roll)}"
            );
        }
    }

    /**
     * @param int $value
     * @return int
     */
    abstract protected function getExpectedPrimaryPropertiesBonusOnFortune($value);

    /**
     * @param AbstractKind $kind
     *
     * @test
     * @depends can_create_self
     */
    public function gives_expected_secondary_properties_bonus_on_fortune(AbstractKind $kind)
    {
        foreach ([1, 2, 3, 4, 5, 6] as $value) {
            $roll = $this->mockery(Roll::class);
            $roll->shouldReceive('getRollSummary')
                ->andReturn($value);
            /** @var Roll $roll */
            $this->assertSame(
                $this->getExpectedSecondaryPropertiesBonusOnFortune($value),
                $kind->getSecondaryPropertiesBonusOnFortune($roll),
                "Value of $value should result to bonus {$this->getExpectedSecondaryPropertiesBonusOnFortune($value)}, but resulted into {$kind->getSecondaryPropertiesBonusOnFortune($roll)}"
            );
        }
    }

    /**
     * @param int $value
     * @return int
     */
    abstract protected function getExpectedSecondaryPropertiesBonusOnFortune($value);

    /**
     * @param AbstractKind $abstractKind
     */
    public function gives_expected_up_to_single_property_limit(AbstractKind $abstractKind)
    {
        $this->assertSame($this->getExpectedUpToSingleProperty(), $abstractKind->getUpToSingleProperty());
    }

    /**
     * @return int
     */
    abstract protected function getExpectedUpToSingleProperty();
}
