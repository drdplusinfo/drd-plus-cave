<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\Exceptions;

class PersonIsAlreadySetTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     * @expectedException \LogicException
     */
    public function is_native_logic_exception()
    {
        throw new PersonIsAlreadySet;
    }

    /**
     * @test
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\Exceptions\Logic
     */
    public function is_marked_by_local_logic_exception()
    {
        throw new PersonIsAlreadySet();
    }
}
