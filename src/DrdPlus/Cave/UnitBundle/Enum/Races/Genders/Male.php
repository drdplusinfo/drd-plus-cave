<?php
namespace DrdPlus\Cave\UnitBundle\Enum\Races\Genders;

/**
 * Male
 * @package DrdPlus\Cave\UnitBundle\Enum\Genders
 */
class Male extends Gender
{
    const CODE = 'male';
    const LABEL = 'Muž';

    /**
     * @return string
     */
    public function getCode()
    {
        return self::CODE;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return self::LABEL;
    }

    /**
     * Get strength modifier
     *
     * @return integer
     */
    public function getStrengthModifier()
    {
        return 0;
    }

    /**
     * Get agility modifier
     *
     * @return integer
     */
    public function getAgilityModifier()
    {
        return 0;
    }

    /**
     * Get knack modifier
     *
     * @return integer
     */
    public function getKnackModifier()
    {
        return 0;
    }

    /**
     * Get will modifier
     *
     * @return integer
     */
    public function getWillModifier()
    {
        return 0;
    }

    /**
     * Get intelligence modifier
     *
     * @return integer
     */
    public function getIntelligenceModifier()
    {
        return 0;
    }

    /**
     * Get charisma modifier
     *
     * @return integer
     */
    public function getCharismaModifier()
    {
        return 0;
    }

}
