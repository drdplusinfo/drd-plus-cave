<?php
namespace DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Agility;
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

    public function __construct(
        LevelValue $levelValue,
        Strength $strengthIncrement,
        Agility $agilityIncrement,
        Knack $knackIncrement,
        Intelligence $intelligenceIncrement,
        Charisma $charismaIncrement,
        Will $willIncrement,
        \DateTimeImmutable $levelUpAt = null
    )
    {
        $this->levelValue = $levelValue;
        $this->strengthIncrement = $strengthIncrement;
        $this->agilityIncrement = $agilityIncrement;
        $this->knackIncrement = $knackIncrement;
        $this->intelligenceIncrement = $intelligenceIncrement;
        $this->charismaIncrement = $charismaIncrement;
        $this->willIncrement = $willIncrement;
        $this->levelUpAt = $levelUpAt ?: new \DateTimeImmutable();
    }

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
    abstract public function getPrimaryPropertyCodes();

    /**
     * Get strength modifier
     *
     * @return int
     */
    public function getStrengthFirstLevelModifier()
    {
        return $this->getPropertyFirstLevelModifier(Strength::STRENGTH);
    }

    /**
     * @param string $propertyCode
     *
     * @return int
     */
    private function getPropertyFirstLevelModifier($propertyCode)
    {
        if (!$this->isFirstLevel()) {
            return 0;
        }

        return $this->isPrimaryProperty($propertyCode)
            ? self::PROPERTY_FIRST_LEVEL_MODIFIER
            : 0;
    }

    /** @return bool */
    public function isFirstLevel()
    {
        return $this->getLevelValue()->getRank() === 1;
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
     * Get agility modifier
     *
     * @return int
     */
    public function getAgilityFirstLevelModifier()
    {
        return $this->getPropertyFirstLevelModifier(Agility::AGILITY);
    }

    /**
     * Get knack modifier
     *
     * @return int
     */
    public function getKnackFirstLevelModifier()
    {
        return $this->getPropertyFirstLevelModifier(Knack::KNACK);
    }

    /**
     * Get will modifier
     *
     * @return int
     */
    public function getWillFirstLevelModifier()
    {
        return $this->getPropertyFirstLevelModifier(Will::WILL);
    }

    /**
     * Get intelligence modifier
     *
     * @return int
     */
    public function getIntelligenceFirstLevelModifier()
    {
        return $this->getPropertyFirstLevelModifier(Intelligence::INTELLIGENCE);
    }

    /**
     * Get charisma modifier
     *
     * @return int
     */
    public function getCharismaFirstLevelModifier()
    {
        return $this->getPropertyFirstLevelModifier(Charisma::CHARISMA);
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
     * @return string
     */
    public function getProfessionCode()
    {
        $underScoredProfessionName = preg_replace('~(\w)([A-Z])~', '$1_$2', $this->getProfessionBaseName());

        return strtolower($underScoredProfessionName);
    }

    /**
     * @return string
     */
    private function getProfessionBaseName()
    {
        return preg_replace('~(\w+\\\)*(\w+)~', '$2', static::class);
    }
}
