<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Person\Attributes\EnumTypes;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use DrdPlus\Cave\UnitBundle\Person\Attributes\EnumTypes\NameType;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Name;
use DrdPlus\Tools\Tests\TestWithMockery;

class NameEnumTypeTest extends TestWithMockery
{

    /**
     * @test
     */
    public function I_can_get_expected_type_name()
    {
        $this->assertSame('name', NameType::NAME);
        $this->assertSame('name', NameType::getTypeName());
    }

    /**
     * @test
     */
    public function I_can_registered_it()
    {
        NameType::registerSelf();
        $this->assertTrue(Type::hasType(NameType::getTypeName()));
    }

    /**
     * @test
     */
    public function I_can_convert_it_to_name()
    {
        $nameType = Type::getType(NameType::getTypeName());
        $phpValue = $nameType->convertToPHPValue($value = 'some string', $this->getPlatform());
        $this->assertInstanceOf(Name::class, $phpValue);
        $this->assertEquals($value, "$phpValue");
    }

    /**
     * @return \Mockery\MockInterface|AbstractPlatform
     */
    private function getPlatform()
    {
        return \Mockery::mock(AbstractPlatform::class);
    }
}
