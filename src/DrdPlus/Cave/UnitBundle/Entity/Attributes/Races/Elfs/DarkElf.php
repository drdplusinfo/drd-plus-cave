<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Elfs;

/**
 * DarkElf
 */
class DarkElf extends Elf
{
    const SUBRACE_CODE = 'dark-elf';

    const BASE_STRENGTH = 0;
    const BASE_AGILITY = 0;
    const BASE_KNACK = 0;
    const BASE_WILL = 0;
    const BASE_CHARISMA = 0;
    const BASE_RESISTANCE = 0;

    /**
     * @return string
     */
    public function getSubRaceCode()
    {
        return self::SUBRACE_CODE;
    }

    /**
     * @return bool
     */
    public function hasInfravision()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function requiresDungeonMasterAgreement()
    {
        return true;
    }
}
