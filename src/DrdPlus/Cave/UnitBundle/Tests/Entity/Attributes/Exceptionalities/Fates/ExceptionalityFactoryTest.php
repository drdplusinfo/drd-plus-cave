<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities;

use Doctrine\DBAL\Types\Type;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities\Fates\Combination;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities\Fates\ExceptionalProperties;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities\Fates\GoodRear;
use DrdPlus\Cave\UnitBundle\Tests\TestWithMockery;

class ExceptionalityFactoryTest extends TestWithMockery
{
    /**
     * @test
     */
    public function can_be_created()
    {
        $instance = new ExceptionalityFactory();
        $this->assertNotNull($instance);

        return $instance;
    }

    /**
     * @test
     * @depends can_be_created
     */
    public function good_rear_is_registered_after_factory_creation()
    {
        $this->assertTrue(Type::hasType(GoodRear::getTypeName()));
    }

    /**
     * @test
     * @depends can_be_created
     */
    public function combination_is_registered_after_factory_creation()
    {
        $this->assertTrue(Type::hasType(Combination::getTypeName()));
    }

    /**
     * @test
     * @depends can_be_created
     */
    public function exceptional_properties_type_is_registered_after_factory_creation()
    {
        $this->assertTrue(Type::hasType(ExceptionalProperties::getTypeName()));
    }

    /**
     * @depends can_be_created
     * @test
     *
     * @param ExceptionalityFactory $factory
     */
    public function can_create_good_rear(ExceptionalityFactory $factory)
    {
        $this->assertInstanceOf(GoodRear::class, $factory->getGoodRear());
    }

    /**
     * @depends can_be_created
     * @test
     *
     * @param ExceptionalityFactory $factory
     */
    public function can_create_combination(ExceptionalityFactory $factory)
    {
        $this->assertInstanceOf(Combination::class, $factory->getCombination());
    }

    /**
     * @depends can_be_created
     * @test
     *
     * @param ExceptionalityFactory $factory
     */
    public function can_create_exceptional_properties(ExceptionalityFactory $factory)
    {
        $this->assertInstanceOf(ExceptionalProperties::class, $factory->getExceptionalProperties());
    }
}
