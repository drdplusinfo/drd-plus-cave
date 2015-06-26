<?php
namespace DrdPlus\Cave\UnitBundle\Person\Races\Orcs;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\RemarkableSenses\Smell;
use DrdPlus\Cave\UnitBundle\Person\Races\Orcs\Genders\OrcGender;
use DrdPlus\Cave\UnitBundle\Person\Races\Race;

/**
 * Orc
 *
 * @method int getStrengthModifier(OrcGender $orcGender),
 * @see Race::getStrengthModifier
 * @method int getAgilityModifier(OrcGender $orcGender)
 * @see Race::getAgilityModifier
 * @method int getKnackModifier(OrcGender $orcGender)
 * @see Race::getKnackModifier
 * @method int getWillModifier(OrcGender $orcGender)
 * @see Race::getWillModifier
 * @method int getIntelligenceModifier(OrcGender $orcGender)
 * @see Race::getIntelligenceModifier
 * @method int getCharismaModifier(OrcGender $orcGender)
 * @see Race::getCharismaModifier
 * @method int getResistanceModifier(OrcGender $orcGender)
 * @see Race::getResistanceModifier
 * @method int getSensesModifier(OrcGender $orcGender)
 * @see Race::getSensesModifier
 */
abstract class Orc extends Race
{
    const RACE_CODE = 'orc';

    // base
    const BASE_AGILITY = +2;
    const BASE_WILL = -1;
    const BASE_CHARISMA = -2;

    // derived
    const BASE_SENSES = +1;

    // body
    const BASE_SIZE = -1;
    const BASE_HEIGHT_IN_CM = 160.0;
    const BASE_WEIGHT_IN_KG = 60.0;

    /**
     * @return bool
     */
    public function hasInfravision()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function requiresDungeonMasterAgreement()
    {
        return true;
    }
    /**
     * @return int
     */
    protected function getBaseSenses()
    {
        return static::BASE_SENSES;
    }

    public function getRemarkableSense()
    {
        return Smell::getIt();
    }
}