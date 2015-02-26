<?php
namespace DrdPlus\Cave\UnitBundle\Exceptions;

class RuntimeTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function is_interface()
    {
        $this->assertTrue(interface_exists(Runtime::class));
    }

    /**
     * @test
     * @expectedException \DrdPlus\Cave\UnitBundle\Exceptions\Exception
     */
    public function extends_local_exception_interface()
    {
        throw new TestRuntimeInterface();
    }

    /**
     * @test
     * @expectedException \DrdPlus\Cave\UnitBundle\Exceptions\Runtime
     */
    public function is_not_logic_exception_interface()
    {
        try {
            throw new TestRuntimeInterface();
        } catch (Logic $shouldNotBeCached) {
            $this->fail('Runtime exception interface must not be a logic exception interface.');
        }
    }

}

/** inner */
class TestRuntimeInterface extends \Exception implements Runtime
{

}
