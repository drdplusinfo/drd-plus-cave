<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Exceptions;

class InconsistentPropertyCodesTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     * @expectedException \LogicException
     */
    public function is_native_logic_exception()
    {
        throw new InconsistentPropertyCodes;
    }

    /**
     * @test
     * @expectedException \DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Exceptions\Logic
     */
    public function is_marked_by_local_logic_exception()
    {
        throw new InconsistentPropertyCodes();
    }
}
