<?php

namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\Professions;

use DrdPlus\Cave\UnitBundle\Entity\Attributes\Property;

/**
 * Profession
 */
abstract class Profession
{

    /**
     * Get name of the profession
     *
     * @return string
     */
    abstract public function getLabel();

    /**
     * @return int
     */
    abstract public function getLevel();

    /**
     * @return string[]
     */
    abstract public function getMainPropertyCodes();

    /**
     * Get strength modifier
     *
     * @return integer
     */
    public function getStrengthModifier()
    {
        return $this->getPropertyModifier(Property::STRENGTH_CODE);
    }

    /**
     * @param string $propertyCode
     * @return int
     */
    private function getPropertyModifier($propertyCode)
    {
        return $this->isMainProperty($propertyCode)
            ? +1
            : 0;
    }

    /**
     * @param string $propertyCode
     * @return bool
     */
    private function isMainProperty($propertyCode)
    {
        return in_array($propertyCode, $this->getMainPropertyCodes());
    }

    /**
     * Get agility modifier
     *
     * @return integer
     */
    public function getAgilityModifier()
    {
        return $this->getPropertyModifier(Property::AGILITY_CODE);
    }

    /**
     * Get knack modifier
     *
     * @return integer
     */
    public function getKnackModifier()
    {
        return $this->getPropertyModifier(Property::KNACK_CODE);
    }

    /**
     * Get will modifier
     *
     * @return integer
     */
    public function getWillModifier()
    {
        return $this->getPropertyModifier(Property::WILL_CODE);
    }

    /**
     * Get intelligence modifier
     *
     * @return integer
     */
    public function getIntelligenceModifier()
    {
        return $this->getPropertyModifier(Property::INTELLIGENCE_CODE);
    }

    /**
     * Get charisma modifier
     *
     * @return integer
     */
    public function getCharismaModifier()
    {
        return $this->getPropertyModifier(Property::CHARISMA_CODE);
    }
}
