<?php
namespace DrdPlus\Cave\UnitBundle\Tests\Person\Races\Elfs;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\RemarkableSenses\Sight;
use DrdPlus\Cave\UnitBundle\Person\Races\Elfs\Elf;
use DrdPlus\Cave\UnitBundle\Tests\Person\Races\AbstractTestOfRace;

class AbstractTestOfElf extends AbstractTestOfRace
{

    /**
     * @param Elf $elf
     *
     * @test
     * @depends can_create_self
     */
    public function has_remarkable_sight(Elf $elf)
    {
        $remarkableSense = $elf->getRemarkableSense();
        $this->assertNotEmpty($remarkableSense);
        $this->assertInstanceOf(Sight::class, $remarkableSense);
    }
}
