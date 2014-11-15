<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races;

use DrdPlus\Cave\UnitBundle\Enum\Enum;

/**
 * Race
 */
abstract class Race extends Enum
{
    /**
     * Code for identification of a race
     *
     * @return string
     */
    abstract public function getCode();

    /**
     * Get strength modifier
     *
     * @return integer
     */
    abstract public function getStrengthModifier();

    /**
     * Get agility modifier
     *
     * @return integer
     */
    abstract public function getAgilityModifier();

    /**
     * Get knack modifier
     *
     * @return integer
     */
    abstract public function getKnackModifier();

    /**
     * Get will modifier
     *
     * @return integer
     */
    abstract public function getWillModifier();

    /**
     * Get intelligence modifier
     *
     * @return integer
     */
    abstract public function getIntelligenceModifier();

    /**
     * Get charisma modifier
     *
     * @return integer
     */
    abstract public function getCharismaModifier();

    /**
     * Get stamina modifier
     *
     * @return integer
     */
    abstract public function getResistanceModifier();

    /**
     * Get senses modifier
     *
     * @return integer
     */
    abstract public function getSensesModifier();

    /**
     * @return bool
     */
    abstract public function hasInfravision();

    /**
     * @return bool
     */
    abstract public function hasNaturalRegeneration();

    /**
     * @return true
     */
    abstract public function requiresDungeonMasterAgreement();
}
