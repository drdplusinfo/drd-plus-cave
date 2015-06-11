<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Person\Attributes\Races\Orcs;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\RemarkableSenses\Smell;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Orcs\Orc;
use DrdPlus\Cave\UnitBundle\Tests\Person\Attributes\Races\AbstractTestOfRace;

class AbstractTestOfOrc extends AbstractTestOfRace
{

    /**
     * @param Orc $orc
     *
     * @test
     * @depends can_create_self
     */
    public function has_remarkable_smell(Orc $orc)
    {
        $remarkableSense = $orc->getRemarkableSense();
        $this->assertNotEmpty($remarkableSense);
        $this->assertInstanceOf(Smell::class, $remarkableSense);
    }
}
