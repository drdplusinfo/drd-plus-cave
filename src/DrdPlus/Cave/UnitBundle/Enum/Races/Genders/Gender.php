<?php

namespace DrdPlus\Cave\UnitBundle\Enum\Races\Genders;

use DrdPlus\Cave\UnitBundle\Enum\Enum;

/**
 * Gender
 */
abstract class Gender extends Enum
{
    const FEMALE = 'žena';

    /**
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

}
