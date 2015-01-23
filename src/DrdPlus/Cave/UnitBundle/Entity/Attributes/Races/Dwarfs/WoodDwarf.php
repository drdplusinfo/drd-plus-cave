<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Dwarfs;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Dwarfs\Genders\WoodDwarfGender;

/**
 * WoodDwarf
 * 
 * @method int getStrengthModifier(WoodDwarfGender $woodDwarfGender),
 * @see Race::getStrengthModifier
 * @method int getAgilityModifier(WoodDwarfGender $woodDwarfGender)
 * @see Race::getAgilityModifier
 * @method int getKnackModifier(WoodDwarfGender $woodDwarfGender)
 * @see Race::getKnackModifier
 * @method int getWillModifier(WoodDwarfGender $woodDwarfGender)
 * @see Race::getWillModifier
 * @method int getIntelligenceModifier(WoodDwarfGender $woodDwarfGender)
 * @see Race::getIntelligenceModifier
 * @method int getCharismaModifier(WoodDwarfGender $woodDwarfGender)
 * @see Race::getCharismaModifier
 * @method int getResistanceModifier(WoodDwarfGender $woodDwarfGender)
 * @see Race::getResistanceModifier
 * @method int nt getSensesModifier(WoodDwarfGender $woodDwarfGender)
 * @see Race::getSensesModifier
 */
class WoodDwarf extends Dwarf
{
    const SUBRACE_CODE = 'wood-dwarf';

    const BASE_WILL = +1;
    const BASE_CHARISMA = -1;

    /**
     * @return string
     */
    public function getSubRaceCode()
    {
        return self::SUBRACE_CODE;
    }

}
