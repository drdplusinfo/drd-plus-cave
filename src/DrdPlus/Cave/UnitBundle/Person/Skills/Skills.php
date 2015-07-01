<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills;

use DrdPlus\Cave\UnitBundle\Person\Person;
use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevels;
use DrdPlus\Cave\UnitBundle\Person\Skills\COmbined\CombinedSkills;
use DrdPlus\Cave\UnitBundle\Person\Skills\Physical\PhysicalSkills;
use DrdPlus\Cave\UnitBundle\Person\Skills\Combined\PsychicalSkills;
use Granam\Strict\Object\StrictObject;

/**
 * Skills
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Skills extends StrictObject
{
    const PHYSICAL = 'physical';
    const PSYCHICAL = 'psychical';
    const COMBINED = 'combined';

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Person
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Person\Person")
     */
    private $person;

    /**
     * @var PhysicalSkills
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Person\Skills\Physical\PhysicalSkills")
     */
    private $physicalSkills;

    /**
     * @var PsychicalSkills
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Person\Skills\Psychical\PsychicalSkills")
     */
    private $psychicalSkills;

    /**
     * @var CombinedSkills
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Person\Skills\Combined\CombinedSkills")
     */
    private $combinedSkills;

    public function __construct()
    {
        $this->physicalSkills = new PhysicalSkills();
        $this->psychicalSkills = new PsychicalSkills();
        $this->combinedSkills = new CombinedSkills();
    }

    public function setPerson(Person $person)
    {
        if (is_null($this->getId()) && is_null($person->getProfessionLevels()->getId())
            && $this !== $person->getProfessionLevels()
        ) {
            throw new \LogicException;
        }

        if ($person->getProfessionLevels()->getId() !== $this->getId()) {
            throw new Exceptions\PersonIsAlreadySet();
        }

        if (!$this->getPerson()) {
            $this->person = $person;
        } elseif ($person->getId() !== $this->getPerson()->getId()) {
            throw new \LogicException();
        }
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get person
     *
     * @return Person|null
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * @return PhysicalSkills
     */
    public function getPhysicalSkills()
    {
        return $this->physicalSkills;
    }

    /**
     * @return PsychicalSkills
     */
    public function getPsychicalSkills()
    {
        return $this->psychicalSkills;
    }

    /**
     * @return CombinedSkills
     */
    public function getCombinedSkills()
    {
        return $this->combinedSkills;
    }

    public function getFreePhysicalSkillPoints()
    {
        $nextLevelsPhysicalPropertiesSum = $this->getNextLevelsPhysicalPropertiesSum($this->getPerson()->getProfessionLevels());
        $firstLevelPotentialPsychicalSkillPoints = $this->getFirstLevelPotentialPhysicalSkillPoints($this->getPerson()->getProfessionLevels());

        return $this->getFreeSkillPoints($nextLevelsPhysicalPropertiesSum, $firstLevelPotentialPsychicalSkillPoints, $this->getPhysicalSkills());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @return int
     */
    private function getNextLevelsPhysicalPropertiesSum(ProfessionLevels $professionLevels)
    {
        return $professionLevels->getNextLevelsAgilityModifier() + $professionLevels->getNextLevelsStrengthModifier();
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @return int
     */
    private function getFirstLevelPotentialPhysicalSkillPoints(ProfessionLevels $professionLevels)
    {
        return $this->getPerson()->getBackground()->getBackgroundSkills()->getPhysicalSkillPoints(
            $professionLevels->getFirstLevel()->getProfession()
        );
    }

    /**
     * @param int $nextLevelsPropertiesSum
     * @param int $potentialFirstLevelSkillPoints
     * @param AbstractSkillsGroup $skillsGroup
     *
     * @return int
     */
    private function getFreeSkillPoints(
        $nextLevelsPropertiesSum,
        $potentialFirstLevelSkillPoints,
        AbstractSkillsGroup $skillsGroup
    )
    {
        return
            ($nextLevelsPropertiesSum /* = potential of skill points */ - $skillsGroup->getNextLevelsSkillRankSummary())
            + ($potentialFirstLevelSkillPoints - $skillsGroup->getFirstLevelsSkillRankSummary());
    }

    /**
     * @return int
     */
    public function getFreePsychicalSkillPoints()
    {
        $nextLevelsPsychicalPropertiesSum = $this->getNextLevelsPsychicalPropertiesSum($this->getPerson()->getProfessionLevels());
        $firstLevelPotentialPsychicalSkillPoints = $this->getFirstLevelPotentialPsychicalSkillPoints($this->getPerson()->getProfessionLevels());

        return $this->getFreeSkillPoints($nextLevelsPsychicalPropertiesSum, $firstLevelPotentialPsychicalSkillPoints, $this->getPsychicalSkills());
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @return int
     */
    private function getNextLevelsPsychicalPropertiesSum(ProfessionLevels $professionLevels)
    {
        return $professionLevels->getNextLevelsIntelligenceModifier() + $professionLevels->getNextLevelsWillModifier();
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @return int
     */
    private function getFirstLevelPotentialPsychicalSkillPoints(ProfessionLevels $professionLevels)
    {
        return $this->getPerson()->getBackground()->getBackgroundSkills()->getPsychicalSkillPoints(
            $professionLevels->getFirstLevel()->getProfession()
        );
    }

    public function getFreeCombinedSkillPoints()
    {
        $nextLevelsCombinedPropertiesSum = $this->getNextLevelsCombinedPropertiesSum($this->getPerson()->getProfessionLevels());
        $firstLevelPotentialCombinedSkillPoints = $this->getFirstLevelPotentialCombinedSkillPoints($this->getPerson()->getProfessionLevels());

        return $this->getFreeSkillPoints($nextLevelsCombinedPropertiesSum, $firstLevelPotentialCombinedSkillPoints, $this->getCombinedSkills());
    }

    private function getNextLevelsCombinedPropertiesSum(ProfessionLevels $professionLevels)
    {
        return $professionLevels->getNextLevelsKnackModifier() + $professionLevels->getNextLevelsCharismaModifier();
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @return int
     */
    private function getFirstLevelPotentialCombinedSkillPoints(ProfessionLevels $professionLevels)
    {
        return $this->getPerson()->getBackground()->getBackgroundSkills()->getCombinedSkillPoints(
            $professionLevels->getFirstLevel()->getProfession()
        );
    }
}
