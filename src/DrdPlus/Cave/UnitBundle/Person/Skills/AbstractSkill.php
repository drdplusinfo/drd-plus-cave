<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills;

use Granam\Strict\Object\StrictObject;

abstract class AbstractSkill extends StrictObject
{
    const MAX_SKILL_RANK = 3;

    /**
     * @var SkillRank
     */
    protected $skillRank;

    public function __construct()
    {
        $this->skillRank = SkillRank::getIt(0);
    }

    public function increaseSkillRank()
    {
        $this->setSkillRank(SkillRank::getIt($this->getSkillRank()->getValue() + 1));
    }

    public function setSkillRank(SkillRank $skillRank)
    {
        if ($this->getSkillRank()->getValue() > $skillRank->getValue()) {
            throw new \LogicException("Higher skill rank is already set. Got {$skillRank->getValue()}, current is  {$this->getSkillRank()->getValue()}");
        }
        if ($this->getSkillRank()->getValue() === static::MAX_SKILL_RANK) {
            throw new \LogicException("Max rank already set");
        }
        $this->skillRank = $skillRank;
    }

    /**
     * @return SkillRank
     */
    public function getSkillRank()
    {
        return $this->skillRank;
    }

    /**
     * @return string[]
     */
    abstract public function getRelatedProperties();

    /**
     * @return bool
     */
    abstract public function isPhysical();

    /**
     * @return bool
     */
    abstract public function isPsychical();

    /**
     * @return bool
     */
    abstract public function isCombined();

}
