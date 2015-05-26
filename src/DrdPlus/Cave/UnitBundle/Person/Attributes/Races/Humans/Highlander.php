<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Humans;

/**
 * Highlander
 * 
 * @see Race::getStrengthModifier
 * @method int getAgilityModifier(Highlander $highlander)
 * @see Race::getAgilityModifier
 * @method int getKnackModifier(Highlander $highlander)
 * @see Race::getKnackModifier
 * @method int getWillModifier(Highlander $highlander)
 * @see Race::getWillModifier
 * @method int getIntelligenceModifier(Highlander $highlander)
 * @see Race::getIntelligenceModifier
 * @method int getCharismaModifier(Highlander $highlander)
 * @see Race::getCharismaModifier
 * @method int getResistanceModifier(Highlander $highlander)
 * @see Race::getResistanceModifier
 * @method int getSensesModifier(Highlander $highlander)
 * @see Race::getSensesModifier
 */
class Highlander extends Human
{
    const SUBRACE_CODE = 'highlander';

    const BASE_STRENGTH = +1;
    const BASE_WILL = +1;
    const BASE_INTELLIGENCE = -1;
    const BASE_CHARISMA = -1;

    /**
     * @return string
     */
    public static function getSubRaceCode()
    {
        return self::SUBRACE_CODE;
    }
}
