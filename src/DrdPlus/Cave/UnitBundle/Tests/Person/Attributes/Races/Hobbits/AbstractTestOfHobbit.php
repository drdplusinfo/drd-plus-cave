<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Person\Attributes\Races\Hobbits;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\RemarkableSenses\Taste;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Hobbits\Hobbit;
use DrdPlus\Cave\UnitBundle\Tests\Person\Attributes\Races\AbstractTestOfRace;

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
