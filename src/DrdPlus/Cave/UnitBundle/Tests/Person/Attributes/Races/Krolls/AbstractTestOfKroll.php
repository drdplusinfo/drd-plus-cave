<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Person\Attributes\Races\Krolls;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\RemarkableSenses\Hearing;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Krolls\Kroll;
use DrdPlus\Cave\UnitBundle\Tests\Person\Attributes\Races\AbstractTestOfRace;

class AbstractTestOfKroll extends AbstractTestOfRace
{

    /**
     * @param Kroll $kroll
     *
     * @test
     * @depends can_create_self
     */
    public function has_remarkable_hearing(Kroll $kroll)
    {
        $remarkableSense = $kroll->getRemarkableSense();
        $this->assertNotEmpty($remarkableSense);
        $this->assertInstanceOf(Hearing::class, $remarkableSense);
    }
}
