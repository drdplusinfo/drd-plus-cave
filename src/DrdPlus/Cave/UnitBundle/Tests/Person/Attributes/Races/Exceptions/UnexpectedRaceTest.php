<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Exceptions;

class UnexpectedRaceTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     * @expectedException \LogicException
     */
    public function is_native_logic_exception()
    {
        throw new UnexpectedRace();
    }

    /**
     * @test
     * @expectedException \DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Exceptions\Logic
     */
    public function is_marked_by_local_logic_exception()
    {
        throw new UnexpectedRace();
    }
}
