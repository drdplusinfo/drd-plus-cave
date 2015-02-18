<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Exceptions;

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
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Exceptions\Exception
     */
    public function extends_entity_exception_interface()
    {
        throw new TestExceptionInterface();
    }

}

/** inner */
class TestExceptionInterface extends \Exception implements Exception
{

}
