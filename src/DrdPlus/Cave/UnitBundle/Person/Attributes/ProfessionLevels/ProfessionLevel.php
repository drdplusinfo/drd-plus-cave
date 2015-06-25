<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Person\Professions\Profession;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\BaseProperty;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Body\WeightInKg;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Will;
use Granam\Strict\Object\StrictObject;

/**
 * ProfessionLevel
 */
abstract class ProfessionLevel extends StrictObject
{

    const PROPERTY_FIRST_LEVEL_MODIFIER = +1;
    const MINIMUM_LEVEL = 1;
    const MAXIMUM_LEVEL = 20;

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
     * @var LevelValue
     *
     * @ORM\Column(type="levelValue")
     */
    private $levelValue;

    /**
     * @var \DateTimeImmutable
     *
     * @ORM\Column(type="datetimeImmutable")
     */
    private $levelUpAt;

    /**
     * @var Strength
     *
     * @ORM\Column(type="strength")
     */
    private $strengthIncrement;

    /**
     * @var Agility
     *
     * @ORM\Column(type="agility")
     */
    private $agilityIncrement;

    /**
     * @var Knack
     *
     * @ORM\Columns(type="knack")
     */
    private $knackIncrement;

    /**
     * @var Will
     *
     * @ORM\Column(type="will")
     */
    private $willIncrement;

    /**
     * @var Intelligence
     *
     * @ORM\Column(type="intelligence")
     */
    private $intelligenceIncrement;

    /**
     * @var Charisma
     *
     * @ORM\Column(type="charisma")
     */
    private $charismaIncrement;

    /**
     * @var WeightInKg
     *
     * @ORM\Column(type="weight_in_kg")
     */
    private $weightInKgIncrement;

    /**
     * @var Profession
     */
    private $profession;

    public function __construct(
        LevelValue $levelValue,
        Strength $strengthIncrement,
        Agility $agilityIncrement,
        Knack $knackIncrement,
        Will $willIncrement,
        Intelligence $intelligenceIncrement,
        Charisma $charismaIncrement,
        WeightInKg $weightInKgIncrement,
        \DateTimeImmutable $levelUpAt = null
    )
    {
        $this->checkLevelValue($levelValue);
        $this->levelValue = $levelValue;
        $this->profession = $this->createProfession();
        $this->checkPropertyIncrement($strengthIncrement, $levelValue);
        $this->strengthIncrement = $strengthIncrement;
        $this->checkPropertyIncrement($agilityIncrement, $levelValue);
        $this->agilityIncrement = $agilityIncrement;
        $this->checkPropertyIncrement($knackIncrement, $levelValue);
        $this->knackIncrement = $knackIncrement;
        $this->checkPropertyIncrement($willIncrement, $levelValue);
        $this->willIncrement = $willIncrement;
        $this->checkPropertyIncrement($intelligenceIncrement, $levelValue);
        $this->intelligenceIncrement = $intelligenceIncrement;
        $this->checkPropertyIncrement($charismaIncrement, $levelValue);
        $this->charismaIncrement = $charismaIncrement;
        $this->checkWeightIncrement($weightInKgIncrement, $levelValue);
        $this->weightInKgIncrement = $weightInKgIncrement;
        $this->levelUpAt = $levelUpAt ?: new \DateTimeImmutable();
    }

    private function checkLevelValue(LevelValue $levelValue)
    {
        if ($levelValue->getValue() < self::MINIMUM_LEVEL) {
            throw new \LogicException(
                "Level value can not be lower than " . self::MINIMUM_LEVEL . ", got {$levelValue->getValue()}"
            );
        }
        if ($levelValue->getValue() > self::MAXIMUM_LEVEL) {
            throw new \LogicException(
                "Level value can not be greater than " . self::MAXIMUM_LEVEL . ", got {$levelValue->getValue()}"
            );
        }
    }

    private function checkPropertyIncrement(BaseProperty $property, LevelValue $levelValue)
    {
        if ($levelValue->getValue() === 1) {
            $this->checkPropertyFirstLevelIncrement($property);
        } else {
            $this->checkNextLevelPropertyIncrement($property);
        }
    }

    private function checkPropertyFirstLevelIncrement(BaseProperty $property)
    {
        if ($property->getValue() !== $this->getPropertyFirstLevelModifier($property->getCode())) {
            throw new \LogicException(
                "On first level has to be the property {$property->getCode()} of value {$this->getPropertyFirstLevelModifier($property->getCode())}"
            );
        }
    }

    private function checkNextLevelPropertyIncrement(BaseProperty $property)
    {
        // TODO - see PPH, page 44
    }

    private function checkWeightIncrement(WeightInKg $weightInKg, LevelValue $levelValue)
    {
        if ($levelValue->getValue() > 1 && $weightInKg->getValue() !== 0) {
            throw new \LogicException(
                "Only first level can change weight. Given {$weightInKg->getValue()} kg weight change on level {$levelValue->getValue()}"
            );
        }
    }

    /**
     * @return Profession
     */
    abstract protected function createProfession();

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
     * @return \DateTimeImmutable
     */
    public function getLevelUpAt()
    {
        return $this->levelUpAt;
    }

    /**
     * @return LevelValue
     */
    public function getLevelValue()
    {
        return $this->levelValue;
    }

    /**
     * @return string[]
     */
    public function getPrimaryPropertyCodes()
    {
        return $this->getProfession()->getPrimaryPropertyCodes();
    }

    /**
     * @param string $propertyCode
     *
     * @return int
     */
    private function getPropertyFirstLevelModifier($propertyCode)
    {
        return $this->isPrimaryProperty($propertyCode)
            ? self::PROPERTY_FIRST_LEVEL_MODIFIER
            : 0;
    }

    /** @return bool */
    public function isFirstLevel()
    {
        return $this->getLevelValue()->getValue() === 1;
    }

    /**
     * @param string $propertyCode
     *
     * @return bool
     */
    public function isPrimaryProperty($propertyCode)
    {
        return in_array($propertyCode, $this->getPrimaryPropertyCodes());
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
     * Get agility increment
     *
     * @return Agility
     */
    public function getAgilityIncrement()
    {
        return $this->agilityIncrement;
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
     * Get intelligence increment
     *
     * @return Intelligence
     */
    public function getIntelligenceIncrement()
    {
        return $this->intelligenceIncrement;
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
     * Get will increment
     *
     * @return Will
     */
    public function getWillIncrement()
    {
        return $this->willIncrement;
    }

    /**
     * Get will increment
     *
     * @return WeightInKg
     */
    public function getWeightInKgIncrement()
    {
        return $this->weightInKgIncrement;
    }

    /**
     * @return Profession
     */
    public function getProfession()
    {
        return $this->profession;
    }
}
