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
        return $this->getRace(Humans\CommonHuman::getRaceCode(), Humans\CommonHuman::getSubraceCode());
    }

    /**
     * @return Humans\Highlander
     */
    public function getHighlander()
    {
        return $this->getRace(Humans\Highlander::getRaceCode(), Humans\Highlander::getSubraceCode());
    }

    /**
     * @return Dwarfs\CommonDwarf
     */
    public function getCommonDwarf()
    {
        return $this->getRace(Dwarfs\CommonDwarf::getRaceCode(), Dwarfs\CommonDwarf::getSubraceCode());
    }

    /**
     * @return Dwarfs\MountainDwarf
     */
    public function getMountainDwarf()
    {
        return $this->getRace(Dwarfs\MountainDwarf::getRaceCode(), Dwarfs\MountainDwarf::getSubraceCode());
    }

    /**
     * @return Dwarfs\WoodDwarf
     */
    public function getWoodDwarf()
    {
        return $this->getRace(Dwarfs\WoodDwarf::getRaceCode(), Dwarfs\WoodDwarf::getSubraceCode());
    }

    /**
     * @return Elfs\CommonElf
     */
    public function getCommonElf()
    {
        return $this->getRace(Elfs\CommonElf::getRaceCode(), Elfs\CommonElf::getSubraceCode());
    }

    /**
     * @return Elfs\DarkElf
     */
    public function getDarkElf()
    {
        return $this->getRace(Elfs\DarkElf::getRaceCode(), Elfs\DarkElf::getSubraceCode());
    }

    /**
     * @return Elfs\GreenElf
     */
    public function getGreenElf()
    {
        return $this->getRace(Elfs\GreenElf::getRaceCode(), Elfs\GreenElf::getSubraceCode());
    }

    /**
     * @return Hobbits\CommonHobbit
     */
    public function getCommonHobbit()
    {
        return $this->getRace(Hobbits\CommonHobbit::getRaceCode(), Hobbits\CommonHobbit::getSubraceCode());
    }

    /**
     * @return Krolls\CommonKroll
     */
    public function getCommonKroll()
    {
        return $this->getRace(Krolls\CommonKroll::getRaceCode(), Krolls\CommonKroll::getSubraceCode());
    }

    /**
     * @return Krolls\WildKroll
     */
    public function getWildKroll()
    {
        return $this->getRace(Krolls\WildKroll::getRaceCode(), Krolls\WildKroll::getSubraceCode());
    }

    /**
     * @return Orcs\CommonOrc
     */
    public function getCommonOrc()
    {
        return $this->getRace(Orcs\CommonOrc::getRaceCode(), Orcs\CommonOrc::getSubraceCode());
    }

    /**
     * @return Orcs\Goblin
     */
    public function getGoblin()
    {
        return $this->getRace(Orcs\Goblin::getRaceCode(), Orcs\Goblin::getSubraceCode());
    }

    /**
     * @return Orcs\Skurut
     */
    public function getSkurut()
    {
        return $this->getRace(Orcs\Skurut::getRaceCode(), Orcs\Skurut::getSubraceCode());
    }

}
