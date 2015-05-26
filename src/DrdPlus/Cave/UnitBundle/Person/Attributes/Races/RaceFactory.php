<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races;

use Granam\Strict\Object\StrictObject;

class RaceFactory extends StrictObject
{
    public function __construct()
    {
        Race::registerSelf();
        Humans\CommonHuman::registerSelfSubRace();
        Humans\Highlander::registerSelfSubRace();
        Dwarfs\CommonDwarf::registerSelfSubRace();
        Dwarfs\MountainDwarf::registerSelfSubRace();
        Dwarfs\WoodDwarf::registerSelfSubRace();
        Elfs\CommonElf::registerSelfSubRace();
        Elfs\DarkElf::registerSelfSubRace();
        Elfs\GreenElf::registerSelfSubRace();
        Hobbits\CommonHobbit::registerSelfSubRace();
        Krolls\CommonKroll::registerSelfSubRace();
        Krolls\WildKroll::registerSelfSubRace();
        Orcs\CommonOrc::registerSelfSubRace();
        Orcs\Goblin::registerSelfSubRace();
        Orcs\Skurut::registerSelfSubRace();
    }

    /**
     * @return Humans\CommonHuman
     */
    public function getCommonHuman()
    {
        return Humans\CommonHuman::getIt();
    }

    /**
     * @return Humans\Highlander
     */
    public function getHighlander()
    {
        return Humans\Highlander::getIt();
    }

    /**
     * @return Dwarfs\CommonDwarf
     */
    public function getCommonDwarf()
    {
        return Dwarfs\CommonDwarf::getIt();
    }

    /**
     * @return Dwarfs\MountainDwarf
     */
    public function getMountainDwarf()
    {
        return Dwarfs\MountainDwarf::getIt();
    }

    /**
     * @return Dwarfs\WoodDwarf
     */
    public function getWoodDwarf()
    {
        return Dwarfs\WoodDwarf::getIt();
    }

    /**
     * @return Elfs\CommonElf
     */
    public function getCommonElf()
    {
        return Elfs\CommonElf::getIt();
    }

    /**
     * @return Elfs\DarkElf
     */
    public function getDarkElf()
    {
        return Elfs\DarkElf::getIt();
    }

    /**
     * @return Elfs\GreenElf
     */
    public function getGreenElf()
    {
        return Elfs\GreenElf::getIt();
    }

    /**
     * @return Hobbits\CommonHobbit
     */
    public function getCommonHobbit()
    {
        return Hobbits\CommonHobbit::getIt();
    }

    /**
     * @return Krolls\CommonKroll
     */
    public function getCommonKroll()
    {
        return Krolls\CommonKroll::getIt();
    }

    /**
     * @return Krolls\WildKroll
     */
    public function getWildKroll()
    {
        return Krolls\WildKroll::getIt();
    }

    /**
     * @return Orcs\CommonOrc
     */
    public function getCommonOrc()
    {
        return Orcs\CommonOrc::getIt();
    }

    /**
     * @return Orcs\Goblin
     */
    public function getGoblin()
    {
        return Orcs\Goblin::getIt();
    }

    /**
     * @return Orcs\Skurut
     */
    public function getSkurut()
    {
        return Orcs\Skurut::getIt();
    }

}
