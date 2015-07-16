<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Parts;

use DrdPlus\Cave\UnitBundle\Tests\TestWithMockery;

class BasePropertyTest extends TestWithMockery
{

    /**
     * @test
     * @expectedException \DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Parts\Exceptions\AbstractPropertyDoesNotHaveTypeName
     */
    public function requesting_property_name_on_abstract_property_cause_exception()
    {
        BaseProperty::getTypeName();
    }

    /**
     * @test
     * @expectedException \DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Parts\Exceptions\CanNotRegisterAbstractProperty
     */
    public function registering_abstract_property_by_itself_cause_exception()
    {
        BaseProperty::registerSelf();
    }

    /**
     * @test
     */
    public function specific_property_can_be_registered()
    {
        TestSomeSpecificBaseProperty::registerSelf();
    }

    /**
     * @test
     * @depends specific_property_can_be_registered
     */
    public function specific_property_can_be_created()
    {
        $someSpecificProperty = TestSomeSpecificBaseProperty::getIt($value = 12345);
        $this->assertInstanceOf(TestSomeSpecificBaseProperty::class, $someSpecificProperty);
        $anotherInstance = TestSomeSpecificBaseProperty::getIt($value + 1);
        $this->assertInstanceOf(TestSomeSpecificBaseProperty::class, $anotherInstance);
        $this->assertNotSame($someSpecificProperty, $anotherInstance);
    }

    /**
     * @test
     * @depends specific_property_can_be_registered
     */
    public function specific_property_can_give_its_value()
    {
        $specificProperty = TestSomeSpecificBaseProperty::getIt($value = 12345);
        $this->assertSame($value, $specificProperty->getValue());
    }

    /**
     * @test
     */
    public function specific_property_type_name_is_automatically_property_name()
    {
        $this->assertSame('test_some_specific_base_property', TestSomeSpecificBaseProperty::getTypeName());
    }

}

/** inner */
class TestSomeSpecificBaseProperty extends BaseProperty
{
    /**
     * @return string
     */
    public function getCode()
    {
        return 'foo';
    }


}
