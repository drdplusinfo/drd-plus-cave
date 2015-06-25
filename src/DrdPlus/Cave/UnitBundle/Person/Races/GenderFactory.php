<?php
namespace DrdPlus\Cave\UnitBundle\Person\Races;

use Granam\Strict\Object\StrictObject;

class GenderFactory extends StrictObject
{

    public function __construct()
    {
        Gender::registerSelf();
        Humans\Genders\CommonHumanMale::registerSelfSubRaceGender();
        Humans\Genders\CommonHumanFemale::registerSelfSubRaceGender();
        Humans\Genders\HighlanderMale::registerSelfSubRaceGender();
        Humans\Genders\HighlanderFemale::registerSelfSubRaceGender();
        Dwarfs\Genders\CommonDwarfMale::registerSelfSubRaceGender();
        Dwarfs\Genders\CommonDwarfFemale::registerSelfSubRaceGender();
        Dwarfs\Genders\MountainDwarfMale::registerSelfSubRaceGender();
        Dwarfs\Genders\MountainDwarfFemale::registerSelfSubRaceGender();
        Dwarfs\Genders\WoodDwarfMale::registerSelfSubRaceGender();
        Dwarfs\Genders\WoodDwarfFemale::registerSelfSubRaceGender();
        Elfs\Genders\CommonElfMale::registerSelfSubRaceGender();
        Elfs\Genders\CommonElfFemale::registerSelfSubRaceGender();
        Elfs\Genders\DarkElfMale::registerSelfSubRaceGender();
        Elfs\Genders\DarkElfFemale::registerSelfSubRaceGender();
        Elfs\Genders\GreenElfMale::registerSelfSubRaceGender();
        Elfs\Genders\GreenElfFemale::registerSelfSubRaceGender();
        Hobbits\Genders\CommonHobbitMale::registerSelfSubRaceGender();
        Hobbits\Genders\CommonHobbitFemale::registerSelfSubRaceGender();
        Krolls\Genders\CommonKrollMale::registerSelfSubRaceGender();
        Krolls\Genders\CommonKrollFemale::registerSelfSubRaceGender();
        Krolls\Genders\WildKrollMale::registerSelfSubRaceGender();
        Krolls\Genders\WildKrollFemale::registerSelfSubRaceGender();
        Orcs\Genders\CommonOrcMale::registerSelfSubRaceGender();
        Orcs\Genders\CommonOrcFemale::registerSelfSubRaceGender();
        Orcs\Genders\GoblinMale::registerSelfSubRaceGender();
        Orcs\Genders\GoblinFemale::registerSelfSubRaceGender();
        Orcs\Genders\SkurutMale::registerSelfSubRaceGender();
        Orcs\Genders\SkurutFemale::registerSelfSubRaceGender();
    }

    /**
     * @return Humans\Genders\CommonHumanMale
     */
    public function getCommonHumanMale()
    {
        return Humans\Genders\CommonHumanMale::getIt();
    }

    /**
     * @return Humans\Genders\CommonHumanFemale
     */
    public function getCommonHumanFemale()
    {
        return Humans\Genders\CommonHumanFemale::getIt();
    }

    /**
     * @return Humans\Genders\HighlanderMale
     */
    public function getHighlanderMale()
    {
        return Humans\Genders\HighlanderMale::getIt();
    }

    /**
     * @return Humans\Genders\HighlanderFemale
     */
    public function getHighlanderFemale()
    {
        return Humans\Genders\HighlanderFemale::getIt();
    }

    /**
     * @return Dwarfs\Genders\CommonDwarfMale
     */
    public function getCommonDwarfMale()
    {
        return Dwarfs\Genders\CommonDwarfMale::getIt();
    }

    /**
     * @return Dwarfs\Genders\CommonDwarfFemale
     */
    public function getCommonDwarfFemale()
    {
        return Dwarfs\Genders\CommonDwarfFemale::getIt();
    }

    /**
     * @return Dwarfs\Genders\MountainDwarfMale
     */
    public function getMountainDwarfMale()
    {
        return Dwarfs\Genders\MountainDwarfMale::getIt();
    }

    /**
     * @return Dwarfs\Genders\MountainDwarfFemale
     */
    public function getMountainDwarfFemale()
    {
        return Dwarfs\Genders\MountainDwarfFemale::getIt();
    }

    /**
     * @return Dwarfs\Genders\WoodDwarfMale
     */
    public function getWoodDwarfMale()
    {
        return Dwarfs\Genders\WoodDwarfMale::getIt();
    }

    /**
     * @return Dwarfs\Genders\WoodDwarfFemale
     */
    public function getWoodDwarfFemale()
    {
        return Dwarfs\Genders\WoodDwarfFemale::getIt();
    }

    /**
     * @return Elfs\Genders\CommonElfMale
     */
    public function getCommonElfMale()
    {
        return Elfs\Genders\CommonElfMale::getIt();
    }

    /**
     * @return Elfs\Genders\CommonElfFemale
     */
    public function getCommonElfFemale()
    {
        return Elfs\Genders\CommonElfFemale::getIt();
    }

    /**
     * @return Elfs\Genders\DarkElfMale
     */
    public function getDarkElfMale()
    {
        return Elfs\Genders\DarkElfMale::getIt();
    }

    /**
     * @return Elfs\Genders\DarkElfFemale
     */
    public function getDarkElfFemale()
    {
        return Elfs\Genders\DarkElfFemale::getIt();
    }

    /**
     * @return Elfs\Genders\GreenElfMale
     */
    public function getGreenElfMale()
    {
        return Elfs\Genders\GreenElfMale::getIt();
    }

    /**
     * @return Elfs\Genders\GreenElfFemale
     */
    public function getGreenElfFemale()
    {
        return Elfs\Genders\GreenElfFemale::getIt();
    }

    /**
     * @return Hobbits\Genders\CommonHobbitMale
     */
    public function getCommonHobbitMale()
    {
        return Hobbits\Genders\CommonHobbitMale::getIt();
    }

    /**
     * @return Hobbits\Genders\CommonHobbitFemale
     */
    public function getCommonHobbitFemale()
    {
        return Hobbits\Genders\CommonHobbitFemale::getIt();
    }

    /**
     * @return Krolls\Genders\CommonKrollMale
     */
    public function getCommonKrollMale()
    {
        return Krolls\Genders\CommonKrollMale::getIt();
    }

    /**
     * @return Krolls\Genders\CommonKrollFemale
     */
    public function getCommonKrollFemale()
    {
        return Krolls\Genders\CommonKrollFemale::getIt();
    }

    /**
     * @return Krolls\Genders\WildKrollMale
     */
    public function getWildKrollMale()
    {
        return Krolls\Genders\WildKrollMale::getIt();
    }

    /**
     * @return Krolls\Genders\WildKrollFemale
     */
    public function getWildKrollFemale()
    {
        return Krolls\Genders\WildKrollFemale::getIt();
    }

    /**
     * @return Orcs\Genders\CommonOrcMale
     */
    public function getCommonOrcMale()
    {
        return Orcs\Genders\CommonOrcMale::getIt();
    }

    /**
     * @return Orcs\Genders\CommonOrcFemale
     */
    public function getCommonOrcFemale()
    {
        return Orcs\Genders\CommonOrcFemale::getIt();
    }

    /**
     * @return Orcs\Genders\GoblinMale
     */
    public function getGoblinMale()
    {
        return Orcs\Genders\GoblinMale::getIt();
    }

    /**
     * @return Orcs\Genders\GoblinFemale
     */
    public function getGoblinFemale()
    {
        return Orcs\Genders\GoblinFemale::getIt();
    }

    /**
     * @return Orcs\Genders\SkurutMale
     */
    public function getSkurutMale()
    {
        return Orcs\Genders\SkurutMale::getIt();
    }

    /**
     * @return Orcs\Genders\SkurutFemale
     */
    public function getSkurutFemale()
    {
        return Orcs\Genders\SkurutFemale::getIt();
    }
}
