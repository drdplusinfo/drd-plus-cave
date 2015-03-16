<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Dwarfs;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Dwarfs\Genders\MountainDwarfGender;

/**
 * MountainDwarf
 * 
 * @method int getStrengthModifier(MountainDwarfGender $mountainDwarfGender),
 * @see Race::getStrengthModifier
 * @method int getAgilityModifier(MountainDwarfGender $mountainDwarfGender)
 * @see Race::getAgilityModifier
 * @method int getKnackModifier(MountainDwarfGender $mountainDwarfGender)
 * @see Race::getKnackModifier
 * @method int getWillModifier(MountainDwarfGender $mountainDwarfGender)
 * @see Race::getWillModifier
 * @method int getIntelligenceModifier(MountainDwarfGender $mountainDwarfGender)
 * @see Race::getIntelligenceModifier
 * @method int getCharismaModifier(MountainDwarfGender $mountainDwarfGender)
 * @see Race::getCharismaModifier
 * @method int getResistanceModifier(MountainDwarfGender $mountainDwarfGender)
 * @see Race::getResistanceModifier
 * @method int getSensesModifier(MountainDwarfGender $mountainDwarfGender)
 * @see Race::getSensesModifier
 */
class MountainDwarf extends Dwarf
{
    const SUBRACE_CODE = 'mountain_dwarf';

    const BASE_STRENGTH = +2;
    const BASE_INTELLIGENCE = -2;

    /**
     * @return string
     */
    public static function getSubRaceCode()
    {
        return self::SUBRACE_CODE;
    }
}
