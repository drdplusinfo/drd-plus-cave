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
     * @var Property
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Property")
     */
    private $strengthIncrement;

    /**
     * @var Property
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Property")
     */
    private $agilityIncrement;

    /**
     * @var Property
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Property")
     */
    private $knackIncrement;

    /**
     * @var Property
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Property")
     */
    private $willIncrement;

    /**
     * @var Property
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Property")
     */
    private $intelligenceIncrement;

    /**
     * @var Property
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Property")
     */
    private $charismaIncrement;

    /**
     * @return int
     */
    abstract public function getProfessionLevel();

    /**
     * @return string[]
     */
    abstract public function getMainPropertyCodes();

    /**
     * Get strength modifier
     *
     * @return int
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
     * @return int
     */
    public function getAgilityFirstLevelModifier()
    {
        return $this->getPropertyFirstLevelModifier(Property::AGILITY_CODE);
    }

    /**
     * Get knack modifier
     *
     * @return int
     */
    public function getKnackFirstLevelModifier()
    {
        return $this->getPropertyFirstLevelModifier(Property::KNACK_CODE);
    }

    /**
     * Get will modifier
     *
     * @return int
     */
    public function getWillFirstLevelModifier()
    {
        return $this->getPropertyFirstLevelModifier(Property::WILL_CODE);
    }

    /**
     * Get intelligence modifier
     *
     * @return int
     */
    public function getIntelligenceFirstLevelModifier()
    {
        return $this->getPropertyFirstLevelModifier(Property::INTELLIGENCE_CODE);
    }

    /**
     * Get charisma modifier
     *
     * @return int
     */
    public function getCharismaFirstLevelModifier()
    {
        return $this->getPropertyFirstLevelModifier(Property::CHARISMA_CODE);
    }

    /**
     * Set strength increment
     *
     * @param Property $strengthIncrement
     * @return $this
     */
    public function setStrengthIncrement(Property $strengthIncrement)
    {
        $strengthIncrement->setLabel(Property::STRENGTH_LABEL);
        $strengthIncrement->setShortLabel(Property::STRENGTH_SHORT_LABEL);
        $this->strengthIncrement = $strengthIncrement;

        return $this;
    }

    /**
     * Get strength increment
     *
     * @return Property
     */
    public function getStrengthIncrement()
    {
        return $this->strengthIncrement;
    }

    /**
     * Set agility increment
     *
     * @param Property $agilityIncrement
     * @return $this
     */
    public function setAgilityIncrement(Property $agilityIncrement)
    {
        $agilityIncrement->setLabel(Property::AGILITY_LABEL);
        $agilityIncrement->setShortLabel(Property::AGILITY_SHORT_LABEL);
        $this->agilityIncrement = $agilityIncrement;

        return $this;
    }

    /**
     * Get agility increment
     *
     * @return Property
     */
    public function getAgilityIncrement()
    {
        return $this->agilityIncrement;
    }

    /**
     * Set charisma increment
     *
     * @param Property $charismaIncrement
     * @return self
     */
    public function setCharismaIncrement(Property $charismaIncrement)
    {
        $charismaIncrement->setLabel(Property::CHARISMA_LABEL);
        $charismaIncrement->setShortLabel(Property::CHARISMA_SHORT_LABEL);
        $this->charismaIncrement = $charismaIncrement;

        return $this;
    }

    /**
     * Get charisma increment
     *
     * @return Property
     */
    public function getCharismaIncrement()
    {
        return $this->charismaIncrement;
    }

    /**
     * Set intelligence increment
     *
     * @param Property $intelligenceIncrement
     * @return self
     */
    public function setIntelligenceIncrement(Property $intelligenceIncrement)
    {
        $intelligenceIncrement->setLabel(Property::INTELLIGENCE_LABEL);
        $intelligenceIncrement->setShortLabel(Property::INTELLIGENCE_SHORT_LABEL);
        $this->intelligenceIncrement = $intelligenceIncrement;

        return $this;
    }

    /**
     * Get intelligence increment
     *
     * @return Property
     */
    public function getIntelligenceIncrement()
    {
        return $this->intelligenceIncrement;
    }

    /**
     * @param Property $knackIncrement
     * @return self
     */
    public function setKnackIncrement(Property $knackIncrement)
    {
        $knackIncrement->setLabel(Property::KNACK_LABEL);
        $knackIncrement->setShortLabel(Property::KNACK_SHORT_LABEL);
        $this->knackIncrement = $knackIncrement;

        return $this;
    }

    /**
     * Get knack increment
     *
     * @return Property
     */
    public function getKnackIncrement()
    {
        return $this->knackIncrement;
    }

    /**
     * Set will increment
     *
     * @param Property $will
     * @return self
     */
    public function setWillIncrement(Property $will)
    {
        $will->setLabel(Property::WILL_LABEL);
        $will->setShortLabel(Property::WILL_SHORT_LABEL);
        $this->willIncrement = $will;

        return $this;
    }

    /**
     * Get will increment
     *
     * @return Property
     */
    public function getWillIncrement()
    {
        return $this->willIncrement;
    }

}
