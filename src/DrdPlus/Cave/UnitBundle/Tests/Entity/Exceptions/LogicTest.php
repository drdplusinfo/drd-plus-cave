<?php
namespace DrdPlus\Cave\UnitBundle\Person\Exceptions;

class LogicTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function is_interface()
    {
        $this->assertTrue(interface_exists(Logic::class));
    }

    /**
     * @test
     * @expectedException \DrdPlus\Cave\UnitBundle\Person\Exceptions\Exception
     */
    public function extends_local_exception_interface()
    {
        throw new TestLogicInterface();
    }

    /**
     * @test
     * @expectedException \DrdPlus\Cave\UnitBundle\Exceptions\Logic
     */
    public function extends_parent_logic_interface()
    {
        throw new TestLogicInterface();
    }

    /**
     * @test
     * @expectedException \DrdPlus\Cave\UnitBundle\Person\Exceptions\Logic
     */
    public function is_not_runtime_exception_interface()
    {
        try {
            throw new TestLogicInterface();
        } catch (Runtime $shouldNotBeCached) {
            $this->fail('Logic exception interface must not be a runtime exception interface.');
        }
    }
}

/** inner */
class TestLogicInterface extends \Exception implements Logic
{

}
