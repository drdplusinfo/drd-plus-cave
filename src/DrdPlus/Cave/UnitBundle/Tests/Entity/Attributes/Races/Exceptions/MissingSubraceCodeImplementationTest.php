<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Exceptions;

class MissingSubraceCodeImplementationTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     * @expectedException \LogicException
     */
    public function is_native_logic_exception()
    {
        throw new MissingSubraceCodeImplementation();
    }

    /**
     * @test
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Exceptions\Logic
     */
    public function is_marked_by_local_logic_exception()
    {
        throw new MissingSubraceCodeImplementation();
    }
}
