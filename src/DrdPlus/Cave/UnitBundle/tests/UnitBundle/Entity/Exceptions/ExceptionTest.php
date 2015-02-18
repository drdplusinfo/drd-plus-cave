<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Exceptions;

class ExceptionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function is_interface()
    {
        $this->assertTrue(interface_exists(Exception::class));
    }

    /**
     * @test
     * @expectedException \DrdPlus\Cave\UnitBundle\Exceptions\Exception
     */
    public function extends_base_unit_bundle_interface()
    {
        throw new TestExceptionInterface();
    }

}

/** inner */
class TestExceptionInterface extends \Exception implements Exception
{

}
