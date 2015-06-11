<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Elfs;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\RemarkableSenses\Sight;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Elfs\Genders\ElfGender;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Race;

/**
 * Elf
 *
 * @method int getStrengthModifier(ElfGender $elfGender),
 * @see Race::getStrengthModifier
 * @method int getAgilityModifier(ElfGender $elfGender)
 * @see Race::getAgilityModifier
 * @method int getKnackModifier(ElfGender $elfGender)
 * @see Race::getKnackModifier
 * @method int getWillModifier(ElfGender $elfGender)
 * @see Race::getWillModifier
 * @method int getIntelligenceModifier(ElfGender $elfGender)
 * @see Race::getIntelligenceModifier
 * @method int getCharismaModifier(ElfGender $elfGender)
 * @see Race::getCharismaModifier
 * @method int getResistanceModifier(ElfGender $elfGender)
 * @see Race::getResistanceModifier
 * @method int getSensesModifier(ElfGender $elfGender)
 * @see Race::getSensesModifier
 */
abstract class Elf extends Race
{
    const RACE_CODE = 'elf';

    const BASE_STRENGTH = -1;
    const BASE_AGILITY = +1;
    const BASE_KNACK = +1;
    const BASE_WILL = -2;
    const BASE_INTELLIGENCE = +1;
    const BASE_CHARISMA = +1;
    const BASE_RESISTANCE = -1;
    const BASE_TOUGHNESS = -1;

    public function getRemarkableSense()
    {
        return Sight::getIt();
    }
}
