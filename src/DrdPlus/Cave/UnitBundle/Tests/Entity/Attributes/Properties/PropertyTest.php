<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Property;

class PropertyTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Exceptions\AbstractPropertyDoesNotHaveTypeName
     */
    public function requesting_property_name_on_abstract_property_cause_exception()
    {
        Property::getTypeName();
    }

    /**
     * @test
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Exceptions\CanNotRegisterAbstractProperty
     */
    public function registering_abstract_property_by_itself_cause_exception()
    {
        Property::registerSelf();
    }

    /**
     * @test
     */
    public function specific_property_can_be_registered()
    {
        TestSomeSpecificProperty::registerSelf();
    }

    /**
     * @test
     * @depends specific_property_can_be_registered
     */
    public function specific_property_can_be_created()
    {
        $someSpecificProperty = TestSomeSpecificProperty::getIt($value = 12345);
        $this->assertInstanceOf(TestSomeSpecificProperty::class, $someSpecificProperty);
        $anotherInstance = TestSomeSpecificProperty::getIt($value + 1);
        $this->assertInstanceOf(TestSomeSpecificProperty::class, $anotherInstance);
        $this->assertNotSame($someSpecificProperty, $anotherInstance);
    }

    /**
     * @test
     */
    public function specific_property_type_name_is_automatically_property_name()
    {
        $this->assertSame('test_some_specific_property', TestSomeSpecificProperty::getTypeName());
    }

    /**
     * @return AbstractPlatform
     */
    protected function getPlatform()
    {
        return \Mockery::mock(AbstractPlatform::class);
    }

}

/** inner */
class TestSomeSpecificProperty extends Property
{

}
