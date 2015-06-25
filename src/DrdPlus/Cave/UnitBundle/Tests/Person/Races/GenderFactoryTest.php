<?php
namespace DrdPlus\Cave\UnitBundle\Person\Races;

use DrdPlus\Cave\UnitBundle\Tests\TestWithMockery;

class GenderFactoryTest extends TestWithMockery
{
    /**
     * @test
     */
    public function can_be_created()
    {
        $instance = new GenderFactory();
        $this->assertNotNull($instance);

        return $instance;
    }

    /**
     * @depends can_be_created
     * @test
     *
     * @param GenderFactory $factory
     */
    public function can_create_common_human_male(GenderFactory $factory)
    {
        $this->assertInstanceOf(Humans\Genders\CommonHumanMale::class, $factory->getCommonHumanMale());
    }

    /**
     * @depends can_be_created
     * @test
     *
     * @param GenderFactory $factory
     */
    public function can_create_common_human_female(GenderFactory $factory)
    {
        $this->assertInstanceOf(Humans\Genders\CommonHumanFemale::class, $factory->getCommonHumanFemale());
    }

    /**
     * @depends can_be_created
     * @test
     *
     * @param GenderFactory $factory
     */
    public function can_create_highlander_male(GenderFactory $factory)
    {
        $this->assertInstanceOf(Humans\Genders\HighlanderMale::class, $factory->getHighlanderMale());
    }

    /**
     * @depends can_be_created
     * @test
     *
     * @param GenderFactory $factory
     */
    public function can_create_highlander_female(GenderFactory $factory)
    {
        $this->assertInstanceOf(Humans\Genders\HighlanderFemale::class, $factory->getHighlanderFemale());
    }

    /**
     * @depends can_be_created
     * @test
     *
     * @param GenderFactory $factory
     */
    public function can_create_common_dwarf_male(GenderFactory $factory)
    {
        $this->assertInstanceOf(Dwarfs\Genders\CommonDwarfMale::class, $factory->getCommonDwarfMale());
    }

    /**
     * @depends can_be_created
     * @test
     *
     * @param GenderFactory $factory
     */
    public function can_create_common_dwarf_female(GenderFactory $factory)
    {
        $this->assertInstanceOf(Dwarfs\Genders\CommonDwarfFemale::class, $factory->getCommonDwarfFemale());
    }

    /**
     * @depends can_be_created
     * @test
     *
     * @param GenderFactory $factory
     */
    public function can_create_mountain_dwarf_male(GenderFactory $factory)
    {
        $this->assertInstanceOf(Dwarfs\Genders\MountainDwarfMale::class, $factory->getMountainDwarfMale());
    }

    /**
     * @depends can_be_created
     * @test
     *
     * @param GenderFactory $factory
     */
    public function can_create_mountain_dwarf_female(GenderFactory $factory)
    {
        $this->assertInstanceOf(Dwarfs\Genders\MountainDwarfFemale::class, $factory->getMountainDwarfFemale());
    }

    /**
     * @depends can_be_created
     * @test
     *
     * @param GenderFactory $factory
     */
    public function can_create_wood_dwarf_male(GenderFactory $factory)
    {
        $this->assertInstanceOf(Dwarfs\Genders\WoodDwarfMale::class, $factory->getWoodDwarfMale());
    }

    /**
     * @depends can_be_created
     * @test
     *
     * @param GenderFactory $factory
     */
    public function can_create_wood_dwarf_female(GenderFactory $factory)
    {
        $this->assertInstanceOf(Dwarfs\Genders\WoodDwarfFEmale::class, $factory->getWoodDwarfFemale());
    }

    /**
     * @depends can_be_created
     * @test
     *
     * @param GenderFactory $factory
     */
    public function can_create_common_elf_male(GenderFactory $factory)
    {
        $this->assertInstanceOf(Elfs\Genders\CommonElfMale::class, $factory->getCommonElfMale());
    }

    /**
     * @depends can_be_created
     * @test
     *
     * @param GenderFactory $factory
     */
    public function can_create_common_elf_female(GenderFactory $factory)
    {
        $this->assertInstanceOf(Elfs\Genders\CommonElfFemale::class, $factory->getCommonElfFemale());
    }

    /**
     * @depends can_be_created
     * @test
     *
     * @param GenderFactory $factory
     */
    public function can_create_dark_elf_male(GenderFactory $factory)
    {
        $this->assertInstanceOf(Elfs\Genders\DarkElfMale::class, $factory->getDarkElfMale());
    }

    /**
     * @depends can_be_created
     * @test
     *
     * @param GenderFactory $factory
     */
    public function can_create_dark_elf_female(GenderFactory $factory)
    {
        $this->assertInstanceOf(Elfs\Genders\DarkElfFemale::class, $factory->getDarkElfFemale());
    }

    /**
     * @depends can_be_created
     * @test
     *
     * @param GenderFactory $factory
     */
    public function can_create_green_elf_male(GenderFactory $factory)
    {
        $this->assertInstanceOf(Elfs\Genders\GreenElfMale::class, $factory->getGreenElfMale());
    }

    /**
     * @depends can_be_created
     * @test
     *
     * @param GenderFactory $factory
     */
    public function can_create_green_elf_female(GenderFactory $factory)
    {
        $this->assertInstanceOf(Elfs\Genders\GreenElfFemale::class, $factory->getGreenElfFemale());
    }

    /**
     * @depends can_be_created
     * @test
     *
     * @param GenderFactory $factory
     */
    public function can_create_common_hobbit_male(GenderFactory $factory)
    {
        $this->assertInstanceOf(Hobbits\Genders\CommonHobbitMale::class, $factory->getCommonHobbitMale());
    }

    /**
     * @depends can_be_created
     * @test
     *
     * @param GenderFactory $factory
     */
    public function can_create_common_hobbit_female(GenderFactory $factory)
    {
        $this->assertInstanceOf(Hobbits\Genders\CommonHobbitFemale::class, $factory->getCommonHobbitFemale());
    }

    /**
     * @depends can_be_created
     * @test
     *
     * @param GenderFactory $factory
     */
    public function can_create_common_kroll_male(GenderFactory $factory)
    {
        $this->assertInstanceOf(Krolls\Genders\CommonKrollMale::class, $factory->getCommonKrollMale());
    }

    /**
     * @depends can_be_created
     * @test
     *
     * @param GenderFactory $factory
     */
    public function can_create_common_kroll_female(GenderFactory $factory)
    {
        $this->assertInstanceOf(Krolls\Genders\CommonKrollFemale::class, $factory->getCommonKrollFemale());
    }

    /**
     * @depends can_be_created
     * @test
     *
     * @param GenderFactory $factory
     */
    public function can_create_wild_kroll_male(GenderFactory $factory)
    {
        $this->assertInstanceOf(Krolls\Genders\WildKrollMale::class, $factory->getWildKrollMale());
    }

    /**
     * @depends can_be_created
     * @test
     *
     * @param GenderFactory $factory
     */
    public function can_create_wild_kroll_female(GenderFactory $factory)
    {
        $this->assertInstanceOf(Krolls\Genders\WildKrollFemale::class, $factory->getWildKrollFemale());
    }

    /**
     * @depends can_be_created
     * @test
     *
     * @param GenderFactory $factory
     */
    public function can_create_common_orc_male(GenderFactory $factory)
    {
        $this->assertInstanceOf(Orcs\Genders\CommonOrcMale::class, $factory->getCommonOrcMale());
    }

    /**
     * @depends can_be_created
     * @test
     *
     * @param GenderFactory $factory
     */
    public function can_create_common_orc_female(GenderFactory $factory)
    {
        $this->assertInstanceOf(Orcs\Genders\CommonOrcFemale::class, $factory->getCommonOrcFemale());
    }

    /**
     * @depends can_be_created
     * @test
     *
     * @param GenderFactory $factory
     */
    public function can_create_goblin_male(GenderFactory $factory)
    {
        $this->assertInstanceOf(Orcs\Genders\GoblinMale::class, $factory->getGoblinMale());
    }

    /**
     * @depends can_be_created
     * @test
     *
     * @param GenderFactory $factory
     */
    public function can_create_goblin_female(GenderFactory $factory)
    {
        $this->assertInstanceOf(Orcs\Genders\GoblinFemale::class, $factory->getGoblinFemale());
    }

    /**
     * @depends can_be_created
     * @test
     *
     * @param GenderFactory $factory
     */
    public function can_create_skurut_male(GenderFactory $factory)
    {
        $this->assertInstanceOf(Orcs\Genders\SkurutMale::class, $factory->getSkurutMale());
    }

    /**
     * @depends can_be_created
     * @test
     *
     * @param GenderFactory $factory
     */
    public function can_create_skurut_female(GenderFactory $factory)
    {
        $this->assertInstanceOf(Orcs\Genders\SkurutFemale::class, $factory->getSkurutFemale());
    }

}
