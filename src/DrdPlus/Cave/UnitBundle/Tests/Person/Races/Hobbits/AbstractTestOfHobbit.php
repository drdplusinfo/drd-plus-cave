<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Person\Races\Hobbits;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\RemarkableSenses\Taste;
use DrdPlus\Cave\UnitBundle\Person\Races\Hobbits\Hobbit;
use DrdPlus\Cave\UnitBundle\Tests\Person\Races\AbstractTestOfRace;

class AbstractTestOfHobbit extends AbstractTestOfRace
{

    /**
     * @param Hobbit $hobbit
     *
     * @test
     * @depends can_create_self
     */
    public function has_remarkable_taste(Hobbit $hobbit)
    {
        $remarkableSense = $hobbit->getRemarkableSense();
        $this->assertNotEmpty($remarkableSense);
        $this->assertInstanceOf(Taste::class, $remarkableSense);
    }
}
