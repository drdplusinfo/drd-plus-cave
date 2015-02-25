<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races;

use Granam\Strict\Object\StrictObject;

class RaceFactory extends StrictObject
{

    /**
     * @param string $raceCode
     * @param string $subraceCode
     * @return Race
     */
    public function getRace($raceCode, $subraceCode)
    {
        return Race::getEnum(Race::buildRaceAndSubraceCode($raceCode, $subraceCode));
    }

    /**
     * @return Humans\CommonHuman
     */
    public function getCommonHuman()
    {
        return $this->getRace(Humans\CommonHuman::RACE_CODE, Humans\CommonHuman::SUBRACE_CODE);
    }

    /**
     * @return Humans\Highlander
     */
    public function getHighlander()
    {
        return $this->getRace(Humans\Highlander::RACE_CODE, Humans\Highlander::SUBRACE_CODE);
    }

    /**
     * @return Dwarfs\CommonDwarf
     */
    public function getCommonDwarf()
    {
        return $this->getRace(Dwarfs\CommonDwarf::RACE_CODE, Dwarfs\CommonDwarf::SUBRACE_CODE);
    }

    /**
     * @return Dwarfs\MountainDwarf
     */
    public function getMountainDwarf()
    {
        return $this->getRace(Dwarfs\MountainDwarf::RACE_CODE, Dwarfs\MountainDwarf::SUBRACE_CODE);
    }

    /**
     * @return Dwarfs\WoodDwarf
     */
    public function getWoodDwarf()
    {
        return $this->getRace(Dwarfs\WoodDwarf::RACE_CODE, Dwarfs\WoodDwarf::SUBRACE_CODE);
    }

    /**
     * @return Elfs\CommonElf
     */
    public function getCommonElf()
    {
        return $this->getRace(Elfs\CommonElf::RACE_CODE, Elfs\CommonElf::SUBRACE_CODE);
    }

    /**
     * @return Elfs\DarkElf
     */
    public function getDarkElf()
    {
        return $this->getRace(Elfs\DarkElf::RACE_CODE, Elfs\DarkElf::SUBRACE_CODE);
    }

    /**
     * @return Elfs\GreenElf
     */
    public function getGreenElf()
    {
        return $this->getRace(Elfs\GreenElf::RACE_CODE, Elfs\GreenElf::SUBRACE_CODE);
    }

    /**
     * @return Hobbits\CommonHobbit
     */
    public function getCommonHobbit()
    {
        return $this->getRace(Hobbits\CommonHobbit::RACE_CODE, Hobbits\CommonHobbit::SUBRACE_CODE);
    }

    /**
     * @return Krolls\CommonKroll
     */
    public function getCommonKroll()
    {
        return $this->getRace(Krolls\CommonKroll::RACE_CODE, Krolls\CommonKroll::SUBRACE_CODE);
    }

    /**
     * @return Krolls\WildKroll
     */
    public function getWildKroll()
    {
        return $this->getRace(Krolls\WildKroll::RACE_CODE, Krolls\WildKroll::SUBRACE_CODE);
    }

    /**
     * @return Orcs\CommonOrc
     */
    public function getCommonOrc()
    {
        return $this->getRace(Orcs\CommonOrc::RACE_CODE, Orcs\CommonOrc::SUBRACE_CODE);
    }

    /**
     * @return Orcs\Goblin
     */
    public function getGoblin()
    {
        return $this->getRace(Orcs\Goblin::RACE_CODE, Orcs\Goblin::SUBRACE_CODE);
    }

    /**
     * @return Orcs\Skurut
     */
    public function getSkurut()
    {
        return $this->getRace(Orcs\Skurut::RACE_CODE, Orcs\Skurut::SUBRACE_CODE);
    }

}
