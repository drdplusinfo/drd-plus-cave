<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Orcs;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Orcs\Genders\OrcGender;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Race;

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

    const BASE_AGILITY = +2;
    const BASE_WILL = -1;
    const BASE_CHARISMA = -2;
    const BASE_SENSES = +1;

    /**
     * @return string
     */
    public static function getRaceCode(){
        return self::RACE_CODE;
    }

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
}
