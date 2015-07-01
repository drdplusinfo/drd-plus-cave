<?php
namespace DrdPlus\Cave\UnitBundle\Person\Background;

use DrdPlus\Cave\UnitBundle\Person\Professions\Fighter;
use DrdPlus\Cave\UnitBundle\Person\Professions\Priest;
use DrdPlus\Cave\UnitBundle\Person\Professions\Ranger;
use DrdPlus\Cave\UnitBundle\Person\Professions\Theurgist;
use DrdPlus\Cave\UnitBundle\Person\Professions\Thief;
use DrdPlus\Cave\UnitBundle\Person\Professions\Wizard;
use DrdPlus\Cave\UnitBundle\Person\Skills\Skills;
use DrdPlus\Cave\UnitBundle\Tools\AbstractTable;

class BackgroundSkillsTable extends AbstractTable
{

    /**
     * @return array
     */
    protected function getExpectedAxisXCompleteHeader()
    {
        /** see PPH page 39, bottom */
        return [
            [ // axis X first row header
                Fighter::FIGHTER, Fighter::FIGHTER, Fighter::FIGHTER,
                Thief::THIEF, Thief::THIEF, Thief::THIEF,
                Ranger::RANGER, Ranger::RANGER, Ranger::RANGER,
                Wizard::WIZARD, Wizard::WIZARD, Wizard::WIZARD,
                Theurgist::THEURGIST, Theurgist::THEURGIST, Theurgist::THEURGIST,
                Priest::PRIEST, Priest::PRIEST, Priest::PRIEST
            ],
            [ // axis X second row header
                Skills::PHYSICAL, Skills::PSYCHICAL, Skills::COMBINED, // fighter
                Skills::PHYSICAL, Skills::PSYCHICAL, Skills::COMBINED, // thief
                Skills::PHYSICAL, Skills::PSYCHICAL, Skills::COMBINED, // ranger
                Skills::PHYSICAL, Skills::PSYCHICAL, Skills::COMBINED, // wizard
                Skills::PHYSICAL, Skills::PSYCHICAL, Skills::COMBINED, // theurgist
                Skills::PHYSICAL, Skills::PSYCHICAL, Skills::COMBINED, // priest
            ]
        ];
    }

    /**
     * @return array
     */
    protected function getExpectedAxisYDataHeader()
    {
        return [
            ['points']
        ];
    }

    /**
     * @return string
     */
    protected function getDataFileName()
    {
        return __DIR__ . '/data/background_skills_table.csv';
    }

    /**
     * @param int $backgroundPoints
     * @return int
     */
    public function getFighterPhysicalSkillPoints($backgroundPoints)
    {
        return $this->getPhysicalSkillPoints($backgroundPoints, Fighter::FIGHTER);
    }

    /**
     * @param int $backgroundPoints
     * @param $professionName
     * @return int
     */
    private function getPhysicalSkillPoints($backgroundPoints, $professionName)
    {
        return $this->getSkillPoints($backgroundPoints, $professionName, Skills::PHYSICAL);
    }

    /**
     * @param int $backgroundPoints
     * @param $professionName
     * @param $skillType
     * @return int
     */
    private function getSkillPoints($backgroundPoints, $professionName, $skillType)
    {
        $skillPoints = $this->getValue([$backgroundPoints], [$professionName, $skillType]);
        if (!is_int($skillPoints)) {
            throw new \LogicException;
        }

        return $skillPoints;
    }

    /**
     * @param int $backgroundPoints
     * @return int
     */
    public function getFighterPsychicalSkillPoints($backgroundPoints)
    {
        return $this->getPsychicalSkillPoints($backgroundPoints, Fighter::FIGHTER);
    }

    /**
     * @param int $backgroundPoints
     * @param $professionName
     * @return int
     */
    private function getPsychicalSkillPoints($backgroundPoints, $professionName)
    {
        return $this->getSkillPoints($backgroundPoints, $professionName, Skills::PSYCHICAL);
    }

    /**
     * @param int $backgroundPoints
     * @return int
     */
    public function getFighterCombinedSkillPoints($backgroundPoints)
    {
        return $this->getCombinedSkillPoints($backgroundPoints, Fighter::FIGHTER);
    }

    /**
     * @param int $backgroundPoints
     * @param $professionName
     * @return int
     */
    private function getCombinedSkillPoints($backgroundPoints, $professionName)
    {
        return $this->getSkillPoints($backgroundPoints, $professionName, Skills::COMBINED);
    }

    /**
     * @param int $backgroundPoints
     * @return int
     */
    public function getThiefPhysicalSkillPoints($backgroundPoints)
    {
        return $this->getPhysicalSkillPoints($backgroundPoints, Thief::THIEF);
    }

    /**
     * @param int $backgroundPoints
     * @return int
     */
    public function getThiefPsychicalSkillPoints($backgroundPoints)
    {
        return $this->getPsychicalSkillPoints($backgroundPoints, Thief::THIEF);
    }

    /**
     * @param int $backgroundPoints
     * @return int
     */
    public function getThiefCombinedSkillPoints($backgroundPoints)
    {
        return $this->getCombinedSkillPoints($backgroundPoints, Thief::THIEF);
    }

    /**
     * @param int $backgroundPoints
     * @return int
     */
    public function getRangerPhysicalSkillPoints($backgroundPoints)
    {
        return $this->getPhysicalSkillPoints($backgroundPoints, Ranger::RANGER);
    }

    /**
     * @param int $backgroundPoints
     * @return int
     */
    public function getRangerPsychicalSkillPoints($backgroundPoints)
    {
        return $this->getPsychicalSkillPoints($backgroundPoints, Ranger::RANGER);
    }

    /**
     * @param int $backgroundPoints
     * @return int
     */
    public function getRangerCombinedSkillPoints($backgroundPoints)
    {
        return $this->getCombinedSkillPoints($backgroundPoints, Ranger::RANGER);
    }

    /**
     * @param int $backgroundPoints
     * @return int
     */
    public function getWizardPhysicalSkillPoints($backgroundPoints)
    {
        return $this->getPhysicalSkillPoints($backgroundPoints, Wizard::WIZARD);
    }

    /**
     * @param int $backgroundPoints
     * @return int
     */
    public function getWizardPsychicalSkillPoints($backgroundPoints)
    {
        return $this->getPsychicalSkillPoints($backgroundPoints, Wizard::WIZARD);
    }

    /**
     * @param int $backgroundPoints
     * @return int
     */
    public function getWizardCombinedSkillPoints($backgroundPoints)
    {
        return $this->getCombinedSkillPoints($backgroundPoints, Wizard::WIZARD);
    }

    /**
     * @param int $backgroundPoints
     * @return int
     */
    public function getTheurgistPhysicalSkillPoints($backgroundPoints)
    {
        return $this->getPhysicalSkillPoints($backgroundPoints, Theurgist::THEURGIST);
    }

    /**
     * @param int $backgroundPoints
     * @return int
     */
    public function getTheurgistPsychicalSkillPoints($backgroundPoints)
    {
        return $this->getPsychicalSkillPoints($backgroundPoints, Theurgist::THEURGIST);
    }

    /**
     * @param int $backgroundPoints
     * @return int
     */
    public function getTheurgistCombinedSkillPoints($backgroundPoints)
    {
        return $this->getCombinedSkillPoints($backgroundPoints, Theurgist::THEURGIST);
    }

    /**
     * @param int $backgroundPoints
     * @return int
     */
    public function getPriestPhysicalSkillPoints($backgroundPoints)
    {
        return $this->getPhysicalSkillPoints($backgroundPoints, Priest::PRIEST);
    }

    /**
     * @param int $backgroundPoints
     * @return int
     */
    public function getPriestPsychicalSkillPoints($backgroundPoints)
    {
        return $this->getPsychicalSkillPoints($backgroundPoints, Priest::PRIEST);
    }

    /**
     * @param int $backgroundPoints
     * @return int
     */
    public function getPriestCombinedSkillPoints($backgroundPoints)
    {
        return $this->getCombinedSkillPoints($backgroundPoints, Priest::PRIEST);
    }

}
