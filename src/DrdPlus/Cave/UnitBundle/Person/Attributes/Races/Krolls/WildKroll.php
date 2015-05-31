<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Krolls;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Krolls\Genders\WildKrollGender;

/**
 * WildKroll
 * 
 * @method int getStrengthModifier(WildKrollGender $wildKrollGender),
 * @see Race::getStrengthModifier
 * @method int getAgilityModifier(WildKrollGender $wildKrollGender)
 * @see Race::getAgilityModifier
 * @method int getKnackModifier(WildKrollGender $wildKrollGender)
 * @see Race::getKnackModifier
 * @method int getWillModifier(WildKrollGender $wildKrollGender)
 * @see Race::getWillModifier
 * @method int getIntelligenceModifier(WildKrollGender $wildKrollGender)
 * @see Race::getIntelligenceModifier
 * @method int getCharismaModifier(WildKrollGender $wildKrollGender)
 * @see Race::getCharismaModifier
 * @method int getResistanceModifier(WildKrollGender $wildKrollGender)
 * @see Race::getResistanceModifier
 * @method int getSensesModifier(WildKrollGender $wildKrollGender)
 * @see Race::getSensesModifier
 */
class WildKroll extends Kroll
{
    const SUBRACE_CODE = 'wild_kroll';

    const BASE_AGILITY = -1;
    const BASE_KNACK = -2;
    const BASE_WILL = +2;
    const BASE_CHARISMA = -2;

    /**
     * @return bool
     */
    public function requiresDungeonMasterAgreement()
    {
        return true;
    }
}
