<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Exceptions;

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
     * @expectedException \DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptions\Exception
     */
    public function extends_parent_exception_interface()
    {
        throw new TestExceptionInterface();
    }

}

/** inner */
class TestExceptionInterface extends \Exception implements Exception
{

}