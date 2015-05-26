<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Orcs;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Orcs\Genders\CommonOrcGender;

/**
 * Class CommonOrc
 * @package DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Orcs
 * 
 * @method int getStrengthModifier(CommonOrcGender $commonOrcGender),
 * @see Race::getStrengthModifier
 * @method int getAgilityModifier(CommonOrcGender $commonOrcGender)
 * @see Race::getAgilityModifier
 * @method int getKnackModifier(CommonOrcGender $commonOrcGender)
 * @see Race::getKnackModifier
 * @method int getWillModifier(CommonOrcGender $commonOrcGender)
 * @see Race::getWillModifier
 * @method int getIntelligenceModifier(CommonOrcGender $commonOrcGender)
 * @see Race::getIntelligenceModifier
 * @method int getCharismaModifier(CommonOrcGender $commonOrcGender)
 * @see Race::getCharismaModifier
 * @method int getResistanceModifier(CommonOrcGender $commonOrcGender)
 * @see Race::getResistanceModifier
 * @method int getSensesModifier(CommonOrcGender $commonOrcGender)
 * @see Race::getSensesModifier
 */
class CommonOrc extends Orc
{
    const SUBRACE_CODE = 'common_orc';

    /**
     * @return string
     */
    public static function getSubraceCode()
    {
        return self::SUBRACE_CODE;
    }
}
