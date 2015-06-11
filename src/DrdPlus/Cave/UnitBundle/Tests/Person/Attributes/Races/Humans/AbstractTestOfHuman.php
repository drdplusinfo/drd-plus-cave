<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Person\Attributes\Races\Humans;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Humans\Human;
use DrdPlus\Cave\UnitBundle\Tests\Person\Attributes\Races\AbstractTestOfRace;

class AbstractTestOfHuman extends AbstractTestOfRace
{

    /**
     * @param Human $human
     *
     * @test
     * @depends can_create_self
     */
    public function has_no_remarkable_sense(Human $human)
    {
        $remarkableSense = $human->getRemarkableSense();
        $this->assertFalse($remarkableSense);
    }
}
