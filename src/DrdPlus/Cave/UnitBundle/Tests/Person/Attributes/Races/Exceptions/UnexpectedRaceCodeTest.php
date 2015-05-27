<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Exceptions;

class UnexpectedRaceCodeTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     * @expectedException \DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Exceptions\UnexpectedRace
     */
    public function is_unexpected_race_exception()
    {
        throw new UnexpectedRaceCode();
    }
}
