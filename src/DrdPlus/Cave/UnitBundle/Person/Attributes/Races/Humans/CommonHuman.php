<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Humans;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Humans\Genders\CommonHumanGender;

/**
 * Class CommonHuman
 * @package DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Humans
 * 
 * @method int getStrengthModifier(CommonHumanGender $commonHumanGender),
 * @see Race::getStrengthModifier
 * @method int getAgilityModifier(CommonHumanGender $commonHumanGender)
 * @see Race::getAgilityModifier
 * @method int getKnackModifier(CommonHumanGender $commonHumanGender)
 * @see Race::getKnackModifier
 * @method int getWillModifier(CommonHumanGender $commonHumanGender)
 * @see Race::getWillModifier
 * @method int getIntelligenceModifier(CommonHumanGender $commonHumanGender)
 * @see Race::getIntelligenceModifier
 * @method int getCharismaModifier(CommonHumanGender $commonHumanGender)
 * @see Race::getCharismaModifier
 * @method int getResistanceModifier(CommonHumanGender $commonHumanGender)
 * @see Race::getResistanceModifier
 * @method int getSensesModifier(CommonHumanGender $commonHumanGender)
 * @see Race::getSensesModifier
 */
class CommonHuman extends Human
{
    const SUBRACE_CODE = 'common_human';

}
