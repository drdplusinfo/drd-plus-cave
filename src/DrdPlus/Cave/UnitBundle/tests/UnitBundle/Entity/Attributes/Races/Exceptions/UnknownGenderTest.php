<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Exceptions;

class UnknownGenderTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     * @expectedException \DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Exceptions\UnknownGenderCode
     */
    public function is_local_unknown_gender_code()
    {
        throw new UnknownGender();
    }
}
