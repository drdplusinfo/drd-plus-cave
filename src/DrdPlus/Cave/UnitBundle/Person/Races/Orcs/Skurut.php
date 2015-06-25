<?php
namespace DrdPlus\Cave\UnitBundle\Person\Races\Orcs;

use DrdPlus\Cave\UnitBundle\Person\Races\Orcs\Genders\SkurutGender;

/**
 * Skurut
 *
 * @method int getStrengthModifier(SkurutGender $skurutGender),
 * @see Race::getStrengthModifier
 * @method int getAgilityModifier(SkurutGender $skurutGender)
 * @see Race::getAgilityModifier
 * @method int getKnackModifier(SkurutGender $skurutGender)
 * @see Race::getKnackModifier
 * @method int getWillModifier(SkurutGender $skurutGender)
 * @see Race::getWillModifier
 * @method int getIntelligenceModifier(SkurutGender $skurutGender)
 * @see Race::getIntelligenceModifier
 * @method int getCharismaModifier(SkurutGender $skurutGender)
 * @see Race::getCharismaModifier
 * @method int getResistanceModifier(SkurutGender $skurutGender)
 * @see Race::getResistanceModifier
 * @method int getSensesModifier(SkurutGender $skurutGender)
 * @see Race::getSensesModifier
 */
class Skurut extends Orc
{
    const SUBRACE_CODE = 'skurut';

    // base
    const BASE_STRENGTH = +1;
    const BASE_AGILITY = +1;
    const BASE_KNACK = -1;
    const BASE_WILL = 0;

    // body
    const BASE_SIZE = +1;
    const BASE_HEIGHT_IN_CM = 180.0;
    const BASE_WEIGHT_IN_KG = 90.0;

}
