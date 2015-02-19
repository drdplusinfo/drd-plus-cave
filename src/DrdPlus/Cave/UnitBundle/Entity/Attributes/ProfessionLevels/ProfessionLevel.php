<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Property;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Will;
use Granam\Strict\Object\StrictObject;

/**
 * ProfessionLevel
 */
abstract class ProfessionLevel extends StrictObject
{

    const PROPERTY_FIRST_LEVEL_MODIFIER = +1;

    /**
     * Have to be protected to allow Doctrine to access it on children
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $level;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $levelUpAt;

    /**
     * @var Property
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Property")
     */
    private $strengthIncrement;

    /**
     * @var Property
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Property")
     */
    private $agilityIncrement;

    /**
     * @var Property
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Property")
     */
    private $knackIncrement;

    /**
     * @var Property
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Property")
     */
    private $willIncrement;

    /**
     * @var Property
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Property")
     */
    private $intelligenceIncrement;

    /**
     * @var Property
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Property")
     */
    private $charismaIncrement;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getLevelUpAt()
    {
        return $this->levelUpAt;
    }

    /**
     * @param \DateTime $levelUpAt
     */
    public function setLevelUpAt(\DateTime $levelUpAt)
    {
        $this->levelUpAt = $levelUpAt;
    }

    /**
     * @param $level
     * @return $this
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @return string[]
     */
    abstract public function getMainPropertyCodes();

    /**
     * @return string
     */
    abstract public function getProfessionCode();

    /**
     * Get strength modifier
     *
     * @return int
     */
    public function getStrengthFirstLevelModifier()
    {
        return $this->getPropertyFirstLevelModifier(Strength::PROPERTY_CODE);
    }

    /**
     * @param string $propertyCode
     * @return int
     */
    private function getPropertyFirstLevelModifier($propertyCode)
    {
        return $this->isMainProperty($propertyCode)
            ? self::PROPERTY_FIRST_LEVEL_MODIFIER
            : 0;
    }

    /**
     * @param string $propertyCode
     * @return bool
     */
    public function isMainProperty($propertyCode)
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
        return $this->getPropertyFirstLevelModifier(Agility::PROPERTY_CODE);
    }

    /**
     * Get knack modifier
     *
     * @return int
     */
    public function getKnackFirstLevelModifier()
    {
        return $this->getPropertyFirstLevelModifier(Knack::PROPERTY_CODE);
    }

    /**
     * Get will modifier
     *
     * @return int
     */
    public function getWillFirstLevelModifier()
    {
        return $this->getPropertyFirstLevelModifier(Will::PROPERTY_CODE);
    }

    /**
     * Get intelligence modifier
     *
     * @return int
     */
    public function getIntelligenceFirstLevelModifier()
    {
        return $this->getPropertyFirstLevelModifier(Intelligence::PROPERTY_CODE);
    }

    /**
     * Get charisma modifier
     *
     * @return int
     */
    public function getCharismaFirstLevelModifier()
    {
        return $this->getPropertyFirstLevelModifier(Charisma::PROPERTY_CODE);
    }

    /**
     * Set strength increment
     *
     * @param Strength $strengthIncrement
     * @return $this
     */
    public function setStrengthIncrement(Strength $strengthIncrement)
    {
        $this->strengthIncrement = $strengthIncrement;

        return $this;
    }

    /**
     * Get strength increment
     *
     * @return Strength
     */
    public function getStrengthIncrement()
    {
        return $this->strengthIncrement;
    }

    /**
     * Set agility increment
     *
     * @param Agility $agilityIncrement
     * @return $this
     */
    public function setAgilityIncrement(Agility $agilityIncrement)
    {
        $this->agilityIncrement = $agilityIncrement;

        return $this;
    }

    /**
     * Get agility increment
     *
     * @return Agility
     */
    public function getAgilityIncrement()
    {
        return $this->agilityIncrement;
    }

    /**
     * Set charisma increment
     *
     * @param Charisma $charismaIncrement
     * @return self
     */
    public function setCharismaIncrement(Charisma $charismaIncrement)
    {
        $this->charismaIncrement = $charismaIncrement;

        return $this;
    }

    /**
     * Get charisma increment
     *
     * @return Charisma
     */
    public function getCharismaIncrement()
    {
        return $this->charismaIncrement;
    }

    /**
     * Set intelligence increment
     *
     * @param Intelligence $intelligenceIncrement
     * @return self
     */
    public function setIntelligenceIncrement(Intelligence $intelligenceIncrement)
    {
        $this->intelligenceIncrement = $intelligenceIncrement;

        return $this;
    }

    /**
     * Get intelligence increment
     *
     * @return Intelligence
     */
    public function getIntelligenceIncrement()
    {
        return $this->intelligenceIncrement;
    }

    /**
     * @param Knack $knackIncrement
     * @return self
     */
    public function setKnackIncrement(Knack $knackIncrement)
    {
        $this->knackIncrement = $knackIncrement;

        return $this;
    }

    /**
     * Get knack increment
     *
     * @return Knack
     */
    public function getKnackIncrement()
    {
        return $this->knackIncrement;
    }

    /**
     * Set will increment
     *
     * @param Will $will
     * @return self
     */
    public function setWillIncrement(Will $will)
    {
        $this->willIncrement = $will;

        return $this;
    }

    /**
     * Get will increment
     *
     * @return Will
     */
    public function getWillIncrement()
    {
        return $this->willIncrement;
    }

}
