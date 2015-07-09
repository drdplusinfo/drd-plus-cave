<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills;

use Granam\Strict\Object\StrictObject;

abstract class AbstractSkillsGroup extends StrictObject implements \Iterator, \Countable
{
    /**
     * @return string
     */
    abstract public function getSkillsGroupName();

    /**
     * @return int
     */
    public function getNextLevelsSkillRankSummary()
    {
        return (int)array_sum(
            array_map(
                function (AbstractSkillRank $skillRank) {
                    return $skillRank->getValue();
                },
                $this->findNextLevelSkillRanks($this->getSkillsIterator()->getArrayCopy())
            )
        );
    }

    /** @return \ArrayIterator */
    abstract protected function getSkillsIterator();

    protected function findNextLevelSkillRanks(array $skillRanks)
    {
        return array_filter(
            $skillRanks,
            function (AbstractSkillRank $skillRank) {
                return $skillRank->getProfessionLevel()->isNextLevel();
            }
        );
    }

    /**
     * @return AbstractSkill[]|array
     */
    public function getSkills()
    {
        return $this->getSkillsIterator()->getArrayCopy();
    }

    public function current()
    {
        return $this->getSkillsIterator()->current();
    }

    public function next()
    {
        $this->getSkillsIterator()->next();
    }

    public function key()
    {
        return $this->getSkillsIterator()->key();
    }

    public function valid()
    {
        return $this->getSkillsIterator()->valid();
    }

    public function rewind()
    {
        $this->getSkillsIterator()->rewind();
    }

    public function count()
    {
        return $this->getSkillsIterator()->count();
    }
}
