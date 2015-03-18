<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Entity\Attributes\Properties;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\InitialProperties;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Entity\Person;
use Granam\Strict\Object\StrictObject;

class InitialPropertiesTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @returns InitialProperties
     *
     * @test
     */
    public function can_create_instance()
    {
        $instance = new InitialProperties();
        $this->assertNotNull($instance);

        return $instance;
    }

    /**
     * @param InitialProperties $initialProperties
     *
     * @test
     * @depends can_create_instance
     */
    public function is_a_strict_object(InitialProperties $initialProperties)
    {
        $this->assertInstanceOf(StrictObject::class, $initialProperties);
    }

    /**
     * @test
     * @depends can_create_instance
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Exceptions\PersonIsNotSet
     */
    public function setting_property_before_person_cause_exception()
    {
        /** @var \Mockery\MockInterface|Strength $strength */
        $strength = \Mockery::mock(Strength::class);
        $strength->shouldReceive('getTypeName')
            ->andReturn('strength');
        $strength->shouldReceive('getEnumValue')
            ->andReturn($initialStrengthValue = 2);
        $initialProperties = new InitialProperties();
        $initialProperties->setInitialStrength($strength);
    }

    /**
     * @test
     * @depends setting_property_before_person_cause_exception
     */
    public function person_can_be_set()
    {
        $initialProperties = new InitialProperties();
        /** @var Person $person */
        $person = \Mockery::mock(Person::class);
        $initialProperties->setPerson($person);
        $this->assertSame($person, $initialProperties->getPerson());
    }

    /**
     * @test
     * @depends person_can_be_set
     */
    public function initial_strength_can_be_set()
    {
        /** @var \Mockery\MockInterface|Strength $strength */
        $strength = \Mockery::mock(Strength::class);
        $strength->shouldReceive('getTypeName')
            ->andReturn('strength');
        $strength->shouldReceive('getEnumValue')
            ->andReturn($initialStrengthValue = 2);
        $initialProperties = $this->getInitialProperties();
        $initialProperties->setInitialStrength($strength);
        $this->assertSame($initialStrengthValue, $initialProperties->getInitialStrength());
    }

    /**
     * @return InitialProperties
     */
    private function getInitialProperties()
    {
        $initialProperties = new InitialProperties();
        /** @var Person $person */
        $person = \Mockery::mock(Person::class);
        $initialProperties->setPerson($person);

        return $initialProperties;
    }

    private function getInitialPropertiesWithSetUpPerson()
    {
        $initialProperties = $this->getInitialProperties();
        $person = $initialProperties->getPerson();
    }

}
