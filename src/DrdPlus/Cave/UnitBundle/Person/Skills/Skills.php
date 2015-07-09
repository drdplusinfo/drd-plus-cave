<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills;

use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevels;
use DrdPlus\Cave\UnitBundle\Person\Skills\Combined\CombinedSkills;
use DrdPlus\Cave\UnitBundle\Person\Skills\Physical\PhysicalSkills;
use DrdPlus\Cave\UnitBundle\Person\Skills\Psychical\PsychicalSkills;
use Granam\Strict\Object\StrictObject;

/**
 * Skills
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Skills extends StrictObject
{
    const PHYSICAL = PhysicalSkills::PHYSICAL;
    const PSYCHICAL = PsychicalSkills::PSYCHICAL;
    const COMBINED = CombinedSkills::COMBINED;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

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

    public function __construct(
        PhysicalSkills $physicalSkills,
        PsychicalSkills $psychicalSkills,
        CombinedSkills $combinedSkills
    )
    {
        $this->physicalSkills = $physicalSkills;
        $this->psychicalSkills = $psychicalSkills;
        $this->combinedSkills = $combinedSkills;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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

    /**
     * @return array|AbstractSkill[]
     */
    public function getSkills()
    {
        return array_merge(
            $this->getPhysicalSkills()->getSkills(),
            $this->getPsychicalSkills()->getSkills(),
            $this->getCombinedSkills()->getSkills()
        );
    }

    /**
     * @param ProfessionLevels $professionLevels
     * @return int
     */
    public function getFreeNextLevelsPhysicalSkillPoints(ProfessionLevels $professionLevels)
    {
        $nextLevelsPhysicalPropertiesSum = $this->getNextLevelsPhysicalPropertiesSum($professionLevels);

        return $this->getFreeNextLevelsSkillPoints($nextLevelsPhysicalPropertiesSum, $this->getPhysicalSkills());
    }

    private function getNextLevelsPhysicalPropertiesSum(ProfessionLevels $professionLevels)
    {
        return $professionLevels->getNextLevelsAgilityModifier() + $professionLevels->getNextLevelsStrengthModifier();
    }

    /**
     * @param int $nextLevelsPropertiesSum as potential of skill points
     * @param AbstractSkillsGroup $skillsGroup
     * @return int
     */
    private function getFreeNextLevelsSkillPoints(
        $nextLevelsPropertiesSum,
        AbstractSkillsGroup $skillsGroup
    )
    {
        return $nextLevelsPropertiesSum - $skillsGroup->getNextLevelsSkillRankSummary();
    }

    /**
     * @param ProfessionLevels $professionLevels
     * @return int
     */
    public function getFreeNextLevelsPsychicalSkillPoints(ProfessionLevels $professionLevels)
    {
        $nextLevelsPsychicalPropertiesSum = $this->getNextLevelsPsychicalPropertiesSum($professionLevels);

        return $this->getFreeNextLevelsSkillPoints($nextLevelsPsychicalPropertiesSum, $this->getPsychicalSkills());
    }

    private function getNextLevelsPsychicalPropertiesSum(ProfessionLevels $professionLevels)
    {
        return $professionLevels->getNextLevelsIntelligenceModifier() + $professionLevels->getNextLevelsWillModifier();
    }

    /**
     * @param ProfessionLevels $professionLevels
     * @return int
     */
    public function getFreeNextLevelsCombinedSkillPoints(ProfessionLevels $professionLevels)
    {
        $nextLevelsCombinedPropertiesSum = $this->getNextLevelsCombinedPropertiesSum($professionLevels);

        return $this->getFreeNextLevelsSkillPoints($nextLevelsCombinedPropertiesSum, $this->getCombinedSkills());
    }

    private function getNextLevelsCombinedPropertiesSum(ProfessionLevels $professionLevels)
    {
        return $professionLevels->getNextLevelsKnackModifier() + $professionLevels->getNextLevelsCharismaModifier();
    }

}
