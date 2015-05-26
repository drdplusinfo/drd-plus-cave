<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Exceptions;

class MissingRaceCodeImplementationTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     * @expectedException \LogicException
     */
    public function is_native_logic_exception()
    {
        throw new MissingRaceCodeImplementation();
    }

    /**
     * @test
     * @expectedException \DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Exceptions\Logic
     */
    public function is_marked_by_local_logic_exception()
    {
        throw new MissingRaceCodeImplementation();
    }
}
