<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races;

use Granam\Strict\Object\StrictObject;

class GenderFactory extends StrictObject
{

    public function __construct()
    {
        Humans\Genders\CommonHumanMale::registerSelf();
        Humans\Genders\CommonHumanFemale::registerSelf();
        Humans\Genders\HighlanderMale::registerSelf();
        Humans\Genders\HighlanderFemale::registerSelf();
        Dwarfs\Genders\CommonDwarfMale::registerSelf();
        Dwarfs\Genders\CommonDwarfFemale::registerSelf();
        Dwarfs\Genders\MountainDwarfMale::registerSelf();
        Dwarfs\Genders\MountainDwarfFemale::registerSelf();
        Dwarfs\Genders\WoodDwarfMale::registerSelf();
        Dwarfs\Genders\WoodDwarfFemale::registerSelf();
        Elfs\Genders\CommonElfMale::registerSelf();
        Elfs\Genders\CommonElfFemale::registerSelf();
        Elfs\Genders\DarkElfMale::registerSelf();
        Elfs\Genders\DarkElfFemale::registerSelf();
        Elfs\Genders\GreenElfMale::registerSelf();
        Elfs\Genders\GreenElfFemale::registerSelf();
        Hobbits\Genders\CommonHobbitMale::registerSelf();
        Hobbits\Genders\CommonHobbitFemale::registerSelf();
        Krolls\Genders\CommonKrollMale::registerSelf();
        Krolls\Genders\CommonKrollFemale::registerSelf();
        Krolls\Genders\WildKrollMale::registerSelf();
        Krolls\Genders\WildKrollFemale::registerSelf();
        Orcs\Genders\CommonOrcMale::registerSelf();
        Orcs\Genders\CommonOrcFemale::registerSelf();
        Orcs\Genders\GoblinMale::registerSelf();
        Orcs\Genders\GoblinFemale::registerSelf();
        Orcs\Genders\SkurutMale::registerSelf();
        Orcs\Genders\SkurutFemale::registerSelf();
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
