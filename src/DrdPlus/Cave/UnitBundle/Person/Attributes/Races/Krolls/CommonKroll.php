<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Krolls;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Krolls\Genders\CommonKrollGender;

/**
 * Class CommonKroll
 * @package DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Krolls
 *
 * @method int getStrengthModifier(CommonKrollGender $commonKrollGender),
 * @see Race::getStrengthModifier
 * @method int getAgilityModifier(CommonKrollGender $commonKrollGender)
 * @see Race::getAgilityModifier
 * @method int getKnackModifier(CommonKrollGender $commonKrollGender)
 * @see Race::getKnackModifier
 * @method int getWillModifier(CommonKrollGender $commonKrollGender)
 * @see Race::getWillModifier
 * @method int getIntelligenceModifier(CommonKrollGender $commonKrollGender)
 * @see Race::getIntelligenceModifier
 * @method int getCharismaModifier(CommonKrollGender $commonKrollGender)
 * @see Race::getCharismaModifier
 * @method int getResistanceModifier(CommonKrollGender $commonKrollGender)
 * @see Race::getResistanceModifier
 * @method int getSensesModifier(CommonKrollGender $commonKrollGender)
 * @see Race::getSensesModifier
 */
class CommonKroll extends Kroll
{
    const SUBRACE_CODE = 'common_kroll';

}
