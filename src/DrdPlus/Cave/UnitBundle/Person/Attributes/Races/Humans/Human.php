<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Humans;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Humans\Genders\HumanGender;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Race;

/**
 * Human
 * 
 * @method int getStrengthModifier(HumanGender $humanGender),
 * @see Race::getStrengthModifier
 * @method int getAgilityModifier(HumanGender $humanGender)
 * @see Race::getAgilityModifier
 * @method int getKnackModifier(HumanGender $humanGender)
 * @see Race::getKnackModifier
 * @method int getWillModifier(HumanGender $humanGender)
 * @see Race::getWillModifier
 * @method int getIntelligenceModifier(HumanGender $humanGender)
 * @see Race::getIntelligenceModifier
 * @method int getCharismaModifier(HumanGender $humanGender)
 * @see Race::getCharismaModifier
 * @method int getResistanceModifier(HumanGender $humanGender)
 * @see Race::getResistanceModifier
 * @method int getSensesModifier(HumanGender $humanGender)
 * @see Race::getSensesModifier
 */
abstract class Human extends Race
{
    const RACE_CODE = 'human';

    // body
    const BASE_WEIGHT_IN_KG = 80.0;
    const BASE_HEIGHT_IN_CM = 180.0;

}
