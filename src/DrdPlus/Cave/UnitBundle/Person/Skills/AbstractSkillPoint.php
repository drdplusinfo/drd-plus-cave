<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Will;
use DrdPlus\Cave\UnitBundle\Person\Background\BackgroundSkills;
use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevel;
use Granam\Integer\IntegerInterface;
use Granam\Strict\Object\StrictObject;

abstract class AbstractSkillPoint extends StrictObject implements IntegerInterface
{
    const SKILL_POINT_VALUE = 1;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @return string
     */
    abstract public function getTypeName();

    /**
     * @return string[]
     */
    abstract public function getRelatedProperties();

    /**
     * @var ProfessionLevel
     *
     * @ORM\OneToOne(target="\DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevel")
     */
    private $professionLevel;

    /**
     * @var BackgroundSkills|null
     *
     * @ORM\OneToOne(targetEntity="\DrdPlus\Cave\UnitBundle\Person\Background\BackgroundSkills")
     */
    private $backgroundSkills;

    /**
     * @var AbstractSkillPoint|null
     *
     * @ORM\OneToOne(targetEntity="\DrdPlus\Cave\UnitBundle\Person\Skills\AbstractSkillPoint")
     */
    private $firstPaidOtherSkillPoint;

    /**
     * @var AbstractSkillPoint|null
     *
     * @ORM\OneToOne(targetEntity="\DrdPlus\Cave\UnitBundle\Person\Skills\AbstractSkillPoint")
     */
    private $secondPaidOtherSkillPoint;

    /** @var bool */
    private $paidByFirstLevelBackgroundSkills = false;
    /** @var bool */
    private $paidByOtherSkillPoints = false;
    /** @var bool */
    private $paidByNextLevelPropertyIncrease = false;

    /**
     * @param ProfessionLevel $professionLevel
     * @param BackgroundSkills $backgroundSkills
     *
     * @return static
     */
    public static function createByFirstLevelBackgroundSkills(ProfessionLevel $professionLevel, BackgroundSkills $backgroundSkills)
    {
        return new static($professionLevel, $backgroundSkills);
    }

    /**
     * @param ProfessionLevel $professionLevel
     * @param AbstractSkillPoint $firstPaidSkillPoint
     * @param AbstractSkillPoint $secondPaidSkillPoint
     *
     * @return static
     */
    public static function createFromCrossGroupSkillPoints(ProfessionLevel $professionLevel, AbstractSkillPoint $firstPaidSkillPoint, AbstractSkillPoint $secondPaidSkillPoint)
    {
        return new static($professionLevel, null /* background skills */, $firstPaidSkillPoint, $secondPaidSkillPoint);
    }

    /**
     * @param ProfessionLevel $professionLevel
     *
     * @return static
     */
    public static function createByRelatedPropertyIncrease(ProfessionLevel $professionLevel)
    {
        return new static($professionLevel);
    }

    /**
     * You can pay by a level (by its property increment respectively) or by two another skill points (as combined and psychical for a new physical)
     *
     * @param ProfessionLevel $professionLevel
     * @param BackgroundSkills $backgroundSkills = null
     * @param AbstractSkillPoint $firstPaidOtherSkillPoint = null
     * @param AbstractSkillPoint $secondPaidOtherSkillPoint = null
     */
    protected function __construct(ProfessionLevel $professionLevel, BackgroundSkills $backgroundSkills = null, AbstractSkillPoint $firstPaidOtherSkillPoint = null, AbstractSkillPoint $secondPaidOtherSkillPoint = null)
    {
        $this->checkPaidProperties($professionLevel, $backgroundSkills, $firstPaidOtherSkillPoint, $secondPaidOtherSkillPoint);
        $this->professionLevel = $professionLevel;
        $this->backgroundSkills = $backgroundSkills;
        $this->firstPaidOtherSkillPoint = $firstPaidOtherSkillPoint;
        $this->secondPaidOtherSkillPoint = $secondPaidOtherSkillPoint;
    }

    protected function checkPaidProperties(ProfessionLevel $professionLevel, BackgroundSkills $backgroundSkills = null, AbstractSkillPoint $firstPaidSkillPoint = null, AbstractSkillPoint $secondPaidSkillPoint = null)
    {
        if ($professionLevel->isFirstLevel() && $backgroundSkills) {
            $this->checkPayByFirstLevelBackgroundSkills($professionLevel, $backgroundSkills);
            $this->paidByFirstLevelBackgroundSkills = true;
        } else if ($professionLevel->isFirstLevel() && ($firstPaidSkillPoint || $secondPaidSkillPoint)) {
            $this->checkPayByOtherSkillPoints($firstPaidSkillPoint, $secondPaidSkillPoint);
            $this->paidByOtherSkillPoints = true;
        } else if ($professionLevel->isNextLevel()) {
            $this->checkPayByLevelPropertyIncrease($professionLevel);
            $this->paidByNextLevelPropertyIncrease = true;
        } else {
            throw new \LogicException('Unknown payment for skill point of profession level with ID ' . $professionLevel->getId());
        }
    }

    /**
     * @param ProfessionLevel $professionLevel
     * @param BackgroundSkills $backgroundSkills
     *
     * @return bool
     */
    protected function checkPayByFirstLevelBackgroundSkills(ProfessionLevel $professionLevel, BackgroundSkills $backgroundSkills)
    {
        $relatedProperties = $this->sortAlphabetically($this->getRelatedProperties());
        $firstLevelSkillPoints = 0;
        switch ($relatedProperties) {
            case $this->sortAlphabetically([Strength::STRENGTH, Agility::AGILITY]) :
                $firstLevelSkillPoints = $backgroundSkills->getPhysicalSkillPoints($professionLevel->getProfession());
                break;
            case $this->sortAlphabetically([Will::WILL, Intelligence::INTELLIGENCE]) :
                $firstLevelSkillPoints = $backgroundSkills->getPsychicalSkillPoints($professionLevel->getProfession());
                break;
            case $this->sortAlphabetically([Knack::KNACK, Charisma::CHARISMA]) :
                $firstLevelSkillPoints = $backgroundSkills->getCombinedSkillPoints($professionLevel->getProfession());
                break;
        }
        if ($firstLevelSkillPoints < 1) {
            throw new \LogicException(
                "First level skill point has to come from the background. No skill point for properties " . implode(',', $relatedProperties) . " is available"
            );
        }

        return true;
    }

    protected function checkPayByOtherSkillPoints(AbstractSkillPoint $firstPaidSkillPoint = null, AbstractSkillPoint $secondPaidSkillPoint = null)
    {
        if (!($firstPaidSkillPoint && $secondPaidSkillPoint)) {
            throw new \LogicException(
                'You can not pay by just a single skill point, the price is two skill points'
            );
        }
        $this->checkPaidSkillPoint($firstPaidSkillPoint);
        $this->checkPaidSkillPoint($secondPaidSkillPoint);
    }

    protected function checkPaidSkillPoint(AbstractSkillPoint $paidSkillPoint)
    {
        if (!$paidSkillPoint->isPaidByFirstLevelBackgroundSkills()) {
            $message = 'Skill points to pay with has to origin from first level background skills.';
            if ($paidSkillPoint->isPaidByNextLevelPropertyIncrease()) {
                $message .= ' Next level skill point is not allowed to trade.';
            }
            if ($paidSkillPoint->isPaidByOtherSkillPoints()) {
                $message .= ' There is no sense to trade first level skill point multiple times.';
            }
            throw new \LogicException($message);
        }
        if ($paidSkillPoint->getTypeName() === $this->getTypeName()) {
            throw new \LogicException(
                "There is no sense to pay for skill point by another one of the very same type ({$this->getTypeName()})."
                . ' Got paid skill point of ID ' . $paidSkillPoint->getId()
            );
        }
    }

    protected function checkPayByLevelPropertyIncrease(ProfessionLevel $professionLevel)
    {
        if ($professionLevel->isFirstLevel()) {
            throw new \LogicException(
                'Skill point can not be obtained by a level property increase for first level.' .
                ' Did you want to use different creation?'
            );
        }
        $relatedProperties = $this->sortAlphabetically($this->getRelatedProperties());
        $missingPropertyIncrement = false;
        switch ($relatedProperties) {
            case $this->sortAlphabetically([Strength::STRENGTH, Agility::AGILITY]) :
                $missingPropertyIncrement = !$professionLevel->getStrengthIncrement()->getValue() && !$professionLevel->getAgilityIncrement()->getValue();
                break;
            case $this->sortAlphabetically([Will::WILL, Intelligence::INTELLIGENCE]) :
                $missingPropertyIncrement = !$professionLevel->getWillIncrement()->getValue() && !$professionLevel->getIntelligenceIncrement()->getValue();
                break;
            case $this->sortAlphabetically([Knack::KNACK, Charisma::CHARISMA]) :
                $missingPropertyIncrement = !$professionLevel->getKnackIncrement()->getValue() && !$professionLevel->getCharismaIncrement()->getValue();
                break;
        }

        if ($missingPropertyIncrement) {
            throw new \LogicException(
                'The profession level of ID ' . $professionLevel->getId() . ' has to have incremented either ' . implode(' or ', $this->getRelatedProperties())
            );
        }
    }

    /**
     * @param array $array
     *
     * @return array
     */
    private function sortAlphabetically(array $array)
    {
        sort($array);

        return $array;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return static::SKILL_POINT_VALUE;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->getValue();
    }

    /**
     * @return ProfessionLevel
     */
    public function getProfessionLevel()
    {
        return $this->professionLevel;
    }

    /**
     * @return BackgroundSkills|null
     */
    public function getBackgroundSkills()
    {
        return $this->backgroundSkills;
    }

    /**
     * @return AbstractSkillPoint|null
     */
    public function getFirstPaidOtherSkillPoint()
    {
        return $this->firstPaidOtherSkillPoint;
    }

    /**
     * @return AbstractSkillPoint|null
     */
    public function getSecondPaidOtherSkillPoint()
    {
        return $this->secondPaidOtherSkillPoint;
    }

    /**
     * @return boolean
     */
    public function isPaidByFirstLevelBackgroundSkills()
    {
        return $this->paidByFirstLevelBackgroundSkills;
    }

    /**
     * @return boolean
     */
    public function isPaidByOtherSkillPoints()
    {
        return $this->paidByOtherSkillPoints;
    }

    /**
     * @return boolean
     */
    public function isPaidByNextLevelPropertyIncrease()
    {
        return $this->paidByNextLevelPropertyIncrease;
    }

}
