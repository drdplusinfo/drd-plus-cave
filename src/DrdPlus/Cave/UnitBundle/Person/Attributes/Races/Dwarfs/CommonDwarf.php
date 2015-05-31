<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Dwarfs;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Dwarfs\Genders\CommonDwarfGender;

/**
 * Class CommonDwarf
 * @package DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Dwarfs
 *
 * @method int getStrengthModifier(CommonDwarfGender $commonDwarfGender),
 * @see Race::getStrengthModifier
 * @method int getAgilityModifier(CommonDwarfGender $commonDwarfGender)
 * @see Race::getAgilityModifier
 * @method int getKnackModifier(CommonDwarfGender $commonDwarfGender)
 * @see Race::getKnackModifier
 * @method int getWillModifier(CommonDwarfGender $commonDwarfGender)
 * @see Race::getWillModifier
 * @method int getIntelligenceModifier(CommonDwarfGender $commonDwarfGender)
 * @see Race::getIntelligenceModifier
 * @method int getCharismaModifier(CommonDwarfGender $commonDwarfGender)
 * @see Race::getCharismaModifier
 * @method int getResistanceModifier(CommonDwarfGender $commonDwarfGender)
 * @see Race::getResistanceModifier
 * @method int getSensesModifier(CommonDwarfGender $commonDwarfGender)
 * @see Race::getSensesModifier
 */
class CommonDwarf extends Dwarf
{

    const SUBRACE_CODE = 'common_dwarf';

}
