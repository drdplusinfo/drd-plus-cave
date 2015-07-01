<?php
namespace DrdPlus\Cave\UnitBundle\Person\Background;

use DrdPlus\Cave\UnitBundle\Person\Background\Parts\AbstractHeritageDependentBackground;
use DrdPlus\Cave\UnitBundle\Person\Professions\Fighter;
use DrdPlus\Cave\UnitBundle\Person\Professions\Priest;
use DrdPlus\Cave\UnitBundle\Person\Professions\Profession;
use DrdPlus\Cave\UnitBundle\Person\Professions\Ranger;
use DrdPlus\Cave\UnitBundle\Person\Professions\Theurgist;
use DrdPlus\Cave\UnitBundle\Person\Professions\Thief;
use DrdPlus\Cave\UnitBundle\Person\Professions\Wizard;

/**
 * @method static BackgroundSkills getEnum(int $backgroundPoints)
 * @method static BackgroundSkills getIt(int $backgroundPoints, Heritage $heritage)
 */
class BackgroundSkills extends AbstractHeritageDependentBackground
{
    /**
     * @var BackgroundSkillsTable
     */
    private $backgroundSkillsTable;

    /**
     * @param Profession $profession
     * @return int
     */
    public function getPhysicalSkillPoints(Profession $profession)
    {
        switch ($profession->getName()) {
            case Fighter::FIGHTER :
                return $this->getBackgroundSkillsTable()->getFighterPhysicalSkillPoints($this->getBackgroundPointsValue());
            case Thief::THIEF :
                return $this->getBackgroundSkillsTable()->getThiefPhysicalSkillPoints($this->getBackgroundPointsValue());
            case Ranger::RANGER :
                return $this->getBackgroundSkillsTable()->getRangerPhysicalSkillPoints($this->getBackgroundPointsValue());
            case Wizard::WIZARD :
                return $this->getBackgroundSkillsTable()->getWizardPhysicalSkillPoints($this->getBackgroundPointsValue());
            case Theurgist::THEURGIST :
                return $this->getBackgroundSkillsTable()->getTheurgistPhysicalSkillPoints($this->getBackgroundPointsValue());
            case Priest::PRIEST :
                return $this->getBackgroundSkillsTable()->getPriestPhysicalSkillPoints($this->getBackgroundPointsValue());
            default :
                throw new \LogicException;
        }
    }

    private function getBackgroundSkillsTable()
    {
        if (!isset($this->backgroundSkillsTable)) {
            $this->backgroundSkillsTable = new BackgroundSkillsTable();
        }

        return $this->backgroundSkillsTable;
    }

    /**
     * @param Profession $profession
     * @return int
     */
    public function getPsychicalSkillPoints(Profession $profession)
    {
        switch ($profession->getName()) {
            case Fighter::FIGHTER :
                return $this->getBackgroundSkillsTable()->getFighterPsychicalSkillPoints($this->getBackgroundPointsValue());
            case Thief::THIEF :
                return $this->getBackgroundSkillsTable()->getThiefPsychicalSkillPoints($this->getBackgroundPointsValue());
            case Ranger::RANGER :
                return $this->getBackgroundSkillsTable()->getRangerPsychicalSkillPoints($this->getBackgroundPointsValue());
            case Wizard::WIZARD :
                return $this->getBackgroundSkillsTable()->getWizardPsychicalSkillPoints($this->getBackgroundPointsValue());
            case Theurgist::THEURGIST :
                return $this->getBackgroundSkillsTable()->getTheurgistPsychicalSkillPoints($this->getBackgroundPointsValue());
            case Priest::PRIEST :
                return $this->getBackgroundSkillsTable()->getPriestPsychicalSkillPoints($this->getBackgroundPointsValue());
            default :
                throw new \LogicException;
        }
    }

    /**
     * @param Profession $profession
     * @return int
     */
    public function getCombinedSkillPoints(Profession $profession)
    {
        switch ($profession->getName()) {
            case Fighter::FIGHTER :
                return $this->getBackgroundSkillsTable()->getFighterCombinedSkillPoints($this->getBackgroundPointsValue());
            case Thief::THIEF :
                return $this->getBackgroundSkillsTable()->getThiefCombinedSkillPoints($this->getBackgroundPointsValue());
            case Ranger::RANGER :
                return $this->getBackgroundSkillsTable()->getRangerCombinedSkillPoints($this->getBackgroundPointsValue());
            case Wizard::WIZARD :
                return $this->getBackgroundSkillsTable()->getWizardCombinedSkillPoints($this->getBackgroundPointsValue());
            case Theurgist::THEURGIST :
                return $this->getBackgroundSkillsTable()->getTheurgistCombinedSkillPoints($this->getBackgroundPointsValue());
            case Priest::PRIEST :
                return $this->getBackgroundSkillsTable()->getPriestCombinedSkillPoints($this->getBackgroundPointsValue());
            default :
                throw new \LogicException;
        }
    }

}
