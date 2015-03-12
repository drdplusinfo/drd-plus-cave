<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Exceptions;

class UnexpectedGenderCodeTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Exceptions\UnexpectedRaceCode
     */
    public function is_local_unexpected_gender_code()
    {
        throw new UnexpectedGenderCode();
    }
}
