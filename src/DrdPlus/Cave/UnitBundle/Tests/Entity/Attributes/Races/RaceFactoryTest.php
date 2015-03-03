<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Dwarfs\CommonDwarf;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Dwarfs\MountainDwarf;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Dwarfs\WoodDwarf;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Elfs\CommonElf;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Elfs\DarkElf;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Elfs\GreenElf;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Hobbits\CommonHobbit;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Humans\CommonHuman;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Humans\Highlander;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Krolls\CommonKroll;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Krolls\WildKroll;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Orcs\CommonOrc;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Orcs\Goblin;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Orcs\Skurut;

class RaceFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function can_be_created()
    {
        $instance = new RaceFactory();
        $this->assertNotNull($instance);

        return $instance;
    }

    /**
     * @depends can_be_created
     * @test
     * @param RaceFactory $factory
     */
    public function can_create_common_human(RaceFactory $factory)
    {
        $this->assertInstanceOf(CommonHuman::class, $factory->getCommonHuman());
    }

    /**
     * @depends can_be_created
     * @test
     * @param RaceFactory $factory
     */
    public function can_create_highlander(RaceFactory $factory)
    {
        $this->assertInstanceOf(Highlander::class, $factory->getHighlander());
    }

    /**
     * @depends can_be_created
     * @test
     * @param RaceFactory $factory
     */
    public function can_create_common_dwarf(RaceFactory $factory)
    {
        $this->assertInstanceOf(CommonDwarf::class, $factory->getCommonDwarf());
    }

    /**
     * @depends can_be_created
     * @test
     * @param RaceFactory $factory
     */
    public function can_create_mountain_dwarf(RaceFactory $factory)
    {
        $this->assertInstanceOf(MountainDwarf::class, $factory->getMountainDwarf());
    }

    /**
     * @depends can_be_created
     * @test
     * @param RaceFactory $factory
     */
    public function can_create_wood_dwarf(RaceFactory $factory)
    {
        $this->assertInstanceOf(WoodDwarf::class, $factory->getWoodDwarf());
    }

    /**
     * @depends can_be_created
     * @test
     * @param RaceFactory $factory
     */
    public function can_create_common_elf(RaceFactory $factory)
    {
        $this->assertInstanceOf(CommonElf::class, $factory->getCommonElf());
    }

    /**
     * @depends can_be_created
     * @test
     * @param RaceFactory $factory
     */
    public function can_create_dark_elf(RaceFactory $factory)
    {
        $this->assertInstanceOf(DarkElf::class, $factory->getDarkElf());
    }

    /**
     * @depends can_be_created
     * @test
     * @param RaceFactory $factory
     */
    public function can_create_green_elf(RaceFactory $factory)
    {
        $this->assertInstanceOf(GreenElf::class, $factory->getGreenElf());
    }

    /**
     * @depends can_be_created
     * @test
     * @param RaceFactory $factory
     */
    public function can_create_common_hobbit(RaceFactory $factory)
    {
        $this->assertInstanceOf(CommonHobbit::class, $factory->getCommonHobbit());
    }

    /**
     * @depends can_be_created
     * @test
     * @param RaceFactory $factory
     */
    public function can_create_common_kroll(RaceFactory $factory)
    {
        $this->assertInstanceOf(CommonKroll::class, $factory->getCommonKroll());
    }

    /**
     * @depends can_be_created
     * @test
     * @param RaceFactory $factory
     */
    public function can_create_wild_kroll(RaceFactory $factory)
    {
        $this->assertInstanceOf(WildKroll::class, $factory->getWildKroll());
    }

    /**
     * @depends can_be_created
     * @test
     * @param RaceFactory $factory
     */
    public function can_create_common_orc(RaceFactory $factory)
    {
        $this->assertInstanceOf(CommonOrc::class, $factory->getCommonOrc());
    }

    /**
     * @depends can_be_created
     * @test
     * @param RaceFactory $factory
     */
    public function can_create_goblin(RaceFactory $factory)
    {
        $this->assertInstanceOf(Goblin::class, $factory->getGoblin());
    }

    /**
     * @depends can_be_created
     * @test
     * @param RaceFactory $factory
     */
    public function can_create_skurut(RaceFactory $factory)
    {
        $this->assertInstanceOf(Skurut::class, $factory->getSkurut());
    }
}
