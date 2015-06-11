<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Person\Attributes\Races\Dwarfs;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\RemarkableSenses\Touch;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Dwarfs\Dwarf;
use DrdPlus\Cave\UnitBundle\Tests\Person\Attributes\Races\AbstractTestOfRace;

class AbstractTestOfDwarf extends AbstractTestOfRace
{

    /**
     * @param Dwarf $dwarf
     *
     * @test
     * @depends can_create_self
     */
    public function has_remarkable_touch(Dwarf $dwarf)
    {
        $remarkableSense = $dwarf->getRemarkableSense();
        $this->assertNotEmpty($remarkableSense);
        $this->assertInstanceOf(Touch::class, $remarkableSense);
    }
}
