<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Dwarfs\CommonDwarf;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Dwarfs\Genders\CommonDwarfFemale;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Dwarfs\Genders\CommonDwarfMale;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Dwarfs\Genders\MountainDwarfFemale;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Dwarfs\Genders\MountainDwarfMale;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Dwarfs\Genders\WoodDwarfFemale;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Dwarfs\Genders\WoodDwarfMale;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Dwarfs\MountainDwarf;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Dwarfs\WoodDwarf;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Elfs\CommonElf;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Elfs\DarkElf;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Elfs\Genders\CommonElfFemale;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Elfs\Genders\CommonElfMale;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Elfs\Genders\DarkElfFemale;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Elfs\Genders\DarkElfMale;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Elfs\Genders\GreenElfFemale;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Elfs\Genders\GreenElfMale;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Elfs\GreenElf;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Hobbits\Genders\HobbitFemale;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Hobbits\Genders\HobbitMale;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Hobbits\Hobbit;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Humans\CommonHuman;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Humans\Genders\CommonHumanFemale;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Humans\Genders\CommonHumanMale;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Humans\Genders\HighlanderFemale;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Humans\Genders\HighlanderMale;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Humans\Highlander;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Krolls\CommonKroll;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Krolls\Genders\CommonKrollFemale;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Krolls\Genders\CommonKrollMale;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Krolls\Genders\WildKrollFemale;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Krolls\Genders\WildKrollMale;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Krolls\WildKroll;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Orcs\CommonOrc;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Orcs\Genders\CommonOrcFemale;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Orcs\Genders\CommonOrcMale;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Orcs\Genders\GoblinFemale;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Orcs\Genders\GoblinMale;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Orcs\Genders\SkurutFemale;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Orcs\Genders\SkurutMale;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Orcs\Goblin;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Orcs\Skurut;
use Granam\StrictObject\StrictObject;

class GenderFactory extends StrictObject
{

    /**
     * @param string $raceCode
     * @param string $subraceCode
     * @param string $genderCode
     * @return Gender
     */
    public function getGender($raceCode, $subraceCode, $genderCode)
    {
        return Gender::get(Gender::buildRaceAndSubraceGenderCode($raceCode, $subraceCode, $genderCode));
    }

    /**
     * @return CommonHumanMale
     */
    public function getCommonHumanMale()
    {
        return $this->getGender(CommonHuman::RACE_CODE, CommonHuman::SUBRACE_CODE, Gender::MALE_CODE);
    }

    /**
     * @return CommonHumanFemale
     */
    public function getCommonHumanFemale()
    {
        return $this->getGender(CommonHuman::RACE_CODE, CommonHuman::SUBRACE_CODE, Gender::FEMALE_CODE);
    }

    /**
     * @return HighlanderMale
     */
    public function getHighlanderMale()
    {
        return $this->getGender(Highlander::RACE_CODE, Highlander::SUBRACE_CODE, Gender::MALE_CODE);
    }

    /**
     * @return HighlanderFemale
     */
    public function getHighlanderFemale()
    {
        return $this->getGender(Highlander::RACE_CODE, Highlander::SUBRACE_CODE, Gender::FEMALE_CODE);
    }

    /**
     * @return CommonDwarfMale
     */
    public function getCommonDwarfMale()
    {
        return $this->getGender(CommonDwarf::RACE_CODE, CommonDwarf::SUBRACE_CODE, Gender::MALE_CODE);
    }

    /**
     * @return CommonDwarfFemale
     */
    public function getCommonDwarfFemale()
    {
        return $this->getGender(CommonDwarf::RACE_CODE, CommonDwarf::SUBRACE_CODE, Gender::FEMALE_CODE);
    }

    /**
     * @return MountainDwarfMale
     */
    public function getMountainDwarfMale()
    {
        return $this->getGender(MountainDwarf::RACE_CODE, MountainDwarf::SUBRACE_CODE, Gender::MALE_CODE);
    }

    /**
     * @return MountainDwarfFemale
     */
    public function getMountainDwarfFemale()
    {
        return $this->getGender(MountainDwarf::RACE_CODE, MountainDwarf::SUBRACE_CODE, Gender::FEMALE_CODE);
    }

    /**
     * @return WoodDwarfMale
     */
    public function getWoodDwarfMale()
    {
        return $this->getGender(WoodDwarf::RACE_CODE, WoodDwarf::SUBRACE_CODE, Gender::MALE_CODE);
    }

    /**
     * @return WoodDwarfFemale
     */
    public function getWoodDwarfFemale()
    {
        return $this->getGender(WoodDwarf::RACE_CODE, WoodDwarf::SUBRACE_CODE, Gender::FEMALE_CODE);
    }

    /**
     * @return CommonElfMale
     */
    public function getCommonElfMale()
    {
        return $this->getGender(CommonElf::RACE_CODE, CommonElf::SUBRACE_CODE, Gender::MALE_CODE);
    }

    /**
     * @return CommonElfFemale
     */
    public function getCommonElfFemale()
    {
        return $this->getGender(CommonElf::RACE_CODE, CommonElf::SUBRACE_CODE, Gender::FEMALE_CODE);
    }

    /**
     * @return DarkElfMale
     */
    public function getDarkElfMale()
    {
        return $this->getGender(DarkElf::RACE_CODE, DarkElf::SUBRACE_CODE, Gender::MALE_CODE);
    }

    /**
     * @return DarkElfFemale
     */
    public function getDarkElfFemale()
    {
        return $this->getGender(DarkElf::RACE_CODE, DarkElf::SUBRACE_CODE, Gender::FEMALE_CODE);
    }

    /**
     * @return GreenElfMale
     */
    public function getGreenElfMale()
    {
        return $this->getGender(GreenElf::RACE_CODE, GreenElf::SUBRACE_CODE, Gender::MALE_CODE);
    }

    /**
     * @return GreenElfFemale
     */
    public function getGreenElfFemale()
    {
        return $this->getGender(GreenElf::RACE_CODE, GreenElf::SUBRACE_CODE, Gender::FEMALE_CODE);
    }

    /**
     * @return HobbitMale
     */
    public function getHobbitMale()
    {
        return $this->getGender(Hobbit::RACE_CODE, Hobbit::SUBRACE_CODE, Gender::MALE_CODE);
    }

    /**
     * @return HobbitFemale
     */
    public function getHobbitFemale()
    {
        return $this->getGender(Hobbit::RACE_CODE, Hobbit::SUBRACE_CODE, Gender::FEMALE_CODE);
    }

    /**
     * @return CommonKrollMale
     */
    public function getCommonKrollMale()
    {
        return $this->getGender(CommonKroll::RACE_CODE, CommonKroll::SUBRACE_CODE, Gender::MALE_CODE);
    }

    /**
     * @return CommonKrollFemale
     */
    public function getCommonKrollFemale()
    {
        return $this->getGender(CommonKroll::RACE_CODE, CommonKroll::SUBRACE_CODE, Gender::FEMALE_CODE);
    }

    /**
     * @return WildKrollMale
     */
    public function getWildKrollMale()
    {
        return $this->getGender(WildKroll::RACE_CODE, WildKroll::SUBRACE_CODE, Gender::MALE_CODE);
    }

    /**
     * @return WildKrollFemale
     */
    public function getWildKrollFemale()
    {
        return $this->getGender(WildKroll::RACE_CODE, WildKroll::SUBRACE_CODE, Gender::FEMALE_CODE);
    }

    /**
     * @return CommonOrcMale
     */
    public function getCommonOrcMale()
    {
        return $this->getGender(CommonOrc::RACE_CODE, CommonOrc::SUBRACE_CODE, Gender::MALE_CODE);
    }

    /**
     * @return CommonOrcFemale
     */
    public function getCommonOrcFemale()
    {
        return $this->getGender(CommonOrc::RACE_CODE, CommonOrc::SUBRACE_CODE, Gender::FEMALE_CODE);
    }

    /**
     * @return GoblinMale
     */
    public function getGoblinMale()
    {
        return $this->getGender(Goblin::RACE_CODE, Goblin::SUBRACE_CODE, Gender::MALE_CODE);
    }

    /**
     * @return GoblinFemale
     */
    public function getGoblinFemale()
    {
        return $this->getGender(Goblin::RACE_CODE, Goblin::SUBRACE_CODE, Gender::FEMALE_CODE);
    }

    /**
     * @return SkurutMale
     */
    public function getSkurutMale()
    {
        return $this->getGender(Skurut::RACE_CODE, Skurut::SUBRACE_CODE, Gender::MALE_CODE);
    }

    /**
     * @return SkurutFemale
     */
    public function getSkurutFemale()
    {
        return $this->getGender(Skurut::RACE_CODE, Skurut::SUBRACE_CODE, Gender::FEMALE_CODE);
    }
}
