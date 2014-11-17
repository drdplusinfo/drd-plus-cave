<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\LevelOfProfession;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Property;

/**
 * ProfessionLevel
 */
abstract class ProfessionLevel
{

    /**
     * @return integer
     */
    abstract public function getProfessionLevel();

    /**
     * Get name of the profession
     *
     * @return string
     */
    abstract public function getLabel();

    /**
     * @return string[]
     */
    abstract public function getMainPropertyCodes();

    /**
     * Get strength modifier
     *
     * @return integer
     */
    public function getStrengthFirstLevelModifier()
    {
        return $this->getPropertyFirstLevelModifier(Property::STRENGTH_CODE);
    }

    /**
     * @param string $propertyCode
     * @return int
     */
    private function getPropertyFirstLevelModifier($propertyCode)
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
    public function getAgilityFirstLevelModifier()
    {
        return $this->getPropertyFirstLevelModifier(Property::AGILITY_CODE);
    }

    /**
     * Get knack modifier
     *
     * @return integer
     */
    public function getKnackFirstLevelModifier()
    {
        return $this->getPropertyFirstLevelModifier(Property::KNACK_CODE);
    }

    /**
     * Get will modifier
     *
     * @return integer
     */
    public function getWillFirstLevelModifier()
    {
        return $this->getPropertyFirstLevelModifier(Property::WILL_CODE);
    }

    /**
     * Get intelligence modifier
     *
     * @return integer
     */
    public function getIntelligenceFirstLevelModifier()
    {
        return $this->getPropertyFirstLevelModifier(Property::INTELLIGENCE_CODE);
    }

    /**
     * Get charisma modifier
     *
     * @return integer
     */
    public function getCharismaFirstLevelModifier()
    {
        return $this->getPropertyFirstLevelModifier(Property::CHARISMA_CODE);
    }
}
