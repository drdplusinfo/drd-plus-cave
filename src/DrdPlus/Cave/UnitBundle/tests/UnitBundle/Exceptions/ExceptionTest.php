<?php
namespace DrdPlus\Cave\UnitBundle\Exceptions;

class ExceptionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function is_interface()
    {
        $this->assertTrue(interface_exists(Exception::class));
    }

}

/** inner */
class TestExceptionInterface extends \Exception implements Exception
{

}
