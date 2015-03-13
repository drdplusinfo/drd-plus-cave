<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Exceptions;

class UnexpectedRaceCodeTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     * @expectedException \LogicException
     */
    public function is_native_logic_exception()
    {
        throw new UnexpectedRaceCode();
    }

    /**
     * @test
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Exceptions\Logic
     */
    public function is_marked_by_local_logic_exception()
    {
        throw new UnexpectedRaceCode();
    }
}