<?php
namespace DrdPlus\Cave\UnitBundle\Person\Races\Krolls;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\RemarkableSenses\Hearing;
use DrdPlus\Cave\UnitBundle\Person\Races\Krolls\Genders\KrollGender;
use DrdPlus\Cave\UnitBundle\Person\Races\Race;

/**
 * Kroll
 *
 * @method int getStrengthModifier(KrollGender $krollGender),
 * @see Race::getStrengthModifier
 * @method int getAgilityModifier(KrollGender $krollGender)
 * @see Race::getAgilityModifier
 * @method int getKnackModifier(KrollGender $krollGender)
 * @see Race::getKnackModifier
 * @method int getWillModifier(KrollGender $krollGender)
 * @see Race::getWillModifier
 * @method int getIntelligenceModifier(KrollGender $krollGender)
 * @see Race::getIntelligenceModifier
 * @method int getCharismaModifier(KrollGender $krollGender)
 * @see Race::getCharismaModifier
 * @method int getResistanceModifier(KrollGender $krollGender)
 * @see Race::getResistanceModifier
 * @method int getSensesModifier(KrollGender $krollGender)
 * @see Race::getSensesModifier
 */
abstract class Kroll extends Race
{
    const RACE_CODE = 'kroll';

    // base properties
    const BASE_STRENGTH = +3;
    const BASE_AGILITY = -2;
    const BASE_KNACK = -1;
    const BASE_WILL = +1;
    const BASE_INTELLIGENCE = -3;
    const BASE_CHARISMA = -1;

    // body
    const BASE_SIZE = +3;
    const BASE_HEIGHT_IN_CM = 220.0;
    const BASE_WEIGHT_IN_KG = 120.0;

    /**
     * @return bool
     */
    public function hasNaturalRegeneration()
    {
        return true;
    }

    public function getRemarkableSense()
    {
        return Hearing::getIt();
    }
}
