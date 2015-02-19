<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races;

use Granam\Strict\Object\StrictObject;

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
     * @return Humans\Genders\CommonHumanMale
     */
    public function getCommonHumanMale()
    {
        return $this->getGender(Humans\CommonHuman::RACE_CODE, Humans\CommonHuman::SUBRACE_CODE, Gender::MALE_CODE);
    }

    /**
     * @return Humans\Genders\CommonHumanFemale
     */
    public function getCommonHumanFemale()
    {
        return $this->getGender(Humans\CommonHuman::RACE_CODE, Humans\CommonHuman::SUBRACE_CODE, Gender::FEMALE_CODE);
    }

    /**
     * @return Humans\Genders\HighlanderMale
     */
    public function getHighlanderMale()
    {
        return $this->getGender(Humans\Highlander::RACE_CODE, Humans\Highlander::SUBRACE_CODE, Gender::MALE_CODE);
    }

    /**
     * @return Humans\Genders\HighlanderFemale
     */
    public function getHighlanderFemale()
    {
        return $this->getGender(Humans\Highlander::RACE_CODE, Humans\Highlander::SUBRACE_CODE, Gender::FEMALE_CODE);
    }

    /**
     * @return Dwarfs\Genders\CommonDwarfMale
     */
    public function getCommonDwarfMale()
    {
        return $this->getGender(Dwarfs\CommonDwarf::RACE_CODE, Dwarfs\CommonDwarf::SUBRACE_CODE, Gender::MALE_CODE);
    }

    /**
     * @return Dwarfs\Genders\CommonDwarfFemale
     */
    public function getCommonDwarfFemale()
    {
        return $this->getGender(Dwarfs\CommonDwarf::RACE_CODE, Dwarfs\CommonDwarf::SUBRACE_CODE, Gender::FEMALE_CODE);
    }

    /**
     * @return Dwarfs\Genders\MountainDwarfMale
     */
    public function getMountainDwarfMale()
    {
        return $this->getGender(Dwarfs\MountainDwarf::RACE_CODE, Dwarfs\MountainDwarf::SUBRACE_CODE, Gender::MALE_CODE);
    }

    /**
     * @return Dwarfs\Genders\MountainDwarfFemale
     */
    public function getMountainDwarfFemale()
    {
        return $this->getGender(Dwarfs\MountainDwarf::RACE_CODE, Dwarfs\MountainDwarf::SUBRACE_CODE, Gender::FEMALE_CODE);
    }

    /**
     * @return Dwarfs\Genders\WoodDwarfMale
     */
    public function getWoodDwarfMale()
    {
        return $this->getGender(Dwarfs\WoodDwarf::RACE_CODE, Dwarfs\WoodDwarf::SUBRACE_CODE, Gender::MALE_CODE);
    }

    /**
     * @return Dwarfs\Genders\WoodDwarfFemale
     */
    public function getWoodDwarfFemale()
    {
        return $this->getGender(Dwarfs\WoodDwarf::RACE_CODE, Dwarfs\WoodDwarf::SUBRACE_CODE, Gender::FEMALE_CODE);
    }

    /**
     * @return Elfs\Genders\CommonElfMale
     */
    public function getCommonElfMale()
    {
        return $this->getGender(Elfs\CommonElf::RACE_CODE, Elfs\CommonElf::SUBRACE_CODE, Gender::MALE_CODE);
    }

    /**
     * @return Elfs\Genders\CommonElfFemale
     */
    public function getCommonElfFemale()
    {
        return $this->getGender(Elfs\CommonElf::RACE_CODE, Elfs\CommonElf::SUBRACE_CODE, Gender::FEMALE_CODE);
    }

    /**
     * @return Elfs\Genders\DarkElfMale
     */
    public function getDarkElfMale()
    {
        return $this->getGender(Elfs\DarkElf::RACE_CODE, Elfs\DarkElf::SUBRACE_CODE, Gender::MALE_CODE);
    }

    /**
     * @return Elfs\Genders\DarkElfFemale
     */
    public function getDarkElfFemale()
    {
        return $this->getGender(Elfs\DarkElf::RACE_CODE, Elfs\DarkElf::SUBRACE_CODE, Gender::FEMALE_CODE);
    }

    /**
     * @return Elfs\Genders\GreenElfMale
     */
    public function getGreenElfMale()
    {
        return $this->getGender(Elfs\GreenElf::RACE_CODE, Elfs\GreenElf::SUBRACE_CODE, Gender::MALE_CODE);
    }

    /**
     * @return Elfs\Genders\GreenElfFemale
     */
    public function getGreenElfFemale()
    {
        return $this->getGender(Elfs\GreenElf::RACE_CODE, Elfs\GreenElf::SUBRACE_CODE, Gender::FEMALE_CODE);
    }

    /**
     * @return Hobbits\Genders\CommonHobbitMale
     */
    public function getCommonHobbitMale()
    {
        return $this->getGender(Hobbits\CommonHobbit::RACE_CODE, Hobbits\CommonHobbit::SUBRACE_CODE, Gender::MALE_CODE);
    }

    /**
     * @return Hobbits\Genders\CommonHobbitFemale
     */
    public function getCommonHobbitFemale()
    {
        return $this->getGender(Hobbits\CommonHobbit::RACE_CODE, Hobbits\CommonHobbit::SUBRACE_CODE, Gender::FEMALE_CODE);
    }

    /**
     * @return Krolls\Genders\CommonKrollMale
     */
    public function getCommonKrollMale()
    {
        return $this->getGender(Krolls\CommonKroll::RACE_CODE, Krolls\CommonKroll::SUBRACE_CODE, Gender::MALE_CODE);
    }

    /**
     * @return Krolls\Genders\CommonKrollFemale
     */
    public function getCommonKrollFemale()
    {
        return $this->getGender(Krolls\CommonKroll::RACE_CODE, Krolls\CommonKroll::SUBRACE_CODE, Gender::FEMALE_CODE);
    }

    /**
     * @return Krolls\Genders\WildKrollMale
     */
    public function getWildKrollMale()
    {
        return $this->getGender(Krolls\WildKroll::RACE_CODE, Krolls\WildKroll::SUBRACE_CODE, Gender::MALE_CODE);
    }

    /**
     * @return Krolls\Genders\WildKrollFemale
     */
    public function getWildKrollFemale()
    {
        return $this->getGender(Krolls\WildKroll::RACE_CODE, Krolls\WildKroll::SUBRACE_CODE, Gender::FEMALE_CODE);
    }

    /**
     * @return Orcs\Genders\CommonOrcMale
     */
    public function getCommonOrcMale()
    {
        return $this->getGender(Orcs\CommonOrc::RACE_CODE, Orcs\CommonOrc::SUBRACE_CODE, Gender::MALE_CODE);
    }

    /**
     * @return Orcs\Genders\CommonOrcFemale
     */
    public function getCommonOrcFemale()
    {
        return $this->getGender(Orcs\CommonOrc::RACE_CODE, Orcs\CommonOrc::SUBRACE_CODE, Gender::FEMALE_CODE);
    }

    /**
     * @return Orcs\Genders\GoblinMale
     */
    public function getGoblinMale()
    {
        return $this->getGender(Orcs\Goblin::RACE_CODE, Orcs\Goblin::SUBRACE_CODE, Gender::MALE_CODE);
    }

    /**
     * @return Orcs\Genders\GoblinFemale
     */
    public function getGoblinFemale()
    {
        return $this->getGender(Orcs\Goblin::RACE_CODE, Orcs\Goblin::SUBRACE_CODE, Gender::FEMALE_CODE);
    }

    /**
     * @return Orcs\Genders\SkurutMale
     */
    public function getSkurutMale()
    {
        return $this->getGender(Orcs\Skurut::RACE_CODE, Orcs\Skurut::SUBRACE_CODE, Gender::MALE_CODE);
    }

    /**
     * @return Orcs\Genders\SkurutFemale
     */
    public function getSkurutFemale()
    {
        return $this->getGender(Orcs\Skurut::RACE_CODE, Orcs\Skurut::SUBRACE_CODE, Gender::FEMALE_CODE);
    }
}
