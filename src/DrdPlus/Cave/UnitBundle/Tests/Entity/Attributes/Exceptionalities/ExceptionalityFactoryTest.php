<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptionalities;

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
     * @depends can_be_created
     * @test
     * @param ExceptionalityFactory $factory
     */
    public function can_create_good_rear(ExceptionalityFactory $factory)
    {
        $this->assertInstanceOf(GoodRear::class, $factory->getGoodRear());
    }

    /**
     * @depends can_be_created
     * @test
     * @param ExceptionalityFactory $factory
     */
    public function can_create_combination(ExceptionalityFactory $factory)
    {
        $this->assertInstanceOf(Combination::class, $factory->getCombination());
    }

    /**
     * @depends can_be_created
     * @test
     * @param ExceptionalityFactory $factory
     */
    public function can_create_exceptional_properties(ExceptionalityFactory $factory)
    {
        $this->assertInstanceOf(ExceptionalProperties::class, $factory->getExceptionalProperties());
    }
}
