<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Humans;

use DrdPlus\Cave\UnitBundle\Enum\Races\Humans\Genders\CommonHumanGender;

class CommonHuman extends Human
{
    const CODE = 'common-human';

    /**
     * @return string
     */
    protected function getSubRaceCode()
    {
        return self::CODE;
    }

    /**
     * Get strength modifier
     *
     * @param CommonHumanGender $highlanderGender
     * @return int
     */
    public function getStrengthModifier(CommonHumanGender $highlanderGender)
    {
        return parent::getStrengthModifier($highlanderGender);
    }

    /**
     * Get agility modifier
     *
     * @param CommonHumanGender $highlanderGender
     * @return int
     */
    public function getAgilityModifier(CommonHumanGender $highlanderGender)
    {
        return parent::getAgilityModifier($highlanderGender);
    }

    /**
     * Get knack modifier
     *
     * @param CommonHumanGender $highlanderGender
     * @return int
     */
    public function getKnackModifier(CommonHumanGender $highlanderGender)
    {
        return parent::getKnackModifier($highlanderGender);
    }

    /**
     * Get will modifier
     *
     * @param CommonHumanGender $highlanderGender
     * @return int
     */
    public function getWillModifier(CommonHumanGender $highlanderGender)
    {
        return parent::getWillModifier($highlanderGender);
    }

    /**
     * Get intelligence modifier
     *
     * @param CommonHumanGender $highlanderGender
     * @return int
     */
    public function getIntelligenceModifier(CommonHumanGender $highlanderGender)
    {
        return parent::getIntelligenceModifier($highlanderGender);
    }

    /**
     * Get charisma modifier
     *
     * @param CommonHumanGender $highlanderGender
     * @return int
     */
    public function getCharismaModifier(CommonHumanGender $highlanderGender)
    {
        return parent::getCharismaModifier($highlanderGender);
    }

    /**
     * Get resistance modifier
     *
     * @param CommonHumanGender $highlanderGender
     * @return int
     */
    public function getResistanceModifier(CommonHumanGender $highlanderGender)
    {
        return parent::getResistanceModifier($highlanderGender);
    }

    /**
     * Get senses modifier
     *
     * @param CommonHumanGender $highlanderGender
     * @return int
     */
    public function getSensesModifier(CommonHumanGender $highlanderGender)
    {
        return parent::getSensesModifier($highlanderGender);
    }
}
