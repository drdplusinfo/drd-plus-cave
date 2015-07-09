<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills;

use Doctrine\ORM\Mapping as ORM;
use Granam\Strict\Object\StrictObject;

/**
 * @ORM\Entity()
 * @ORM\Table()
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({
 *  "physical" = "AbstractPhysicalSkill",
 *  "psychical" = "AbstractPsychicalSkill",
 *  "combined" = "AbstractCombinedSkill",
 * })
 */
abstract class AbstractSkill extends StrictObject
{
    /**
     * @var AbstractSkillRank[]
     *
     * @ORM\OneToMany(targetEntity="DrdPlus\Cave\UnitBundle\Person\Skills\AbstractSkillRank")
     */
    protected $skillRanks = [];

    public function __construct(ZeroSkillRank $skillRank)
    {
        $this->addSkillRank($skillRank);
    }

    public function addSkillRank(AbstractSkillRank $skillRank)
    {
        if (!(count($this->getSkillRanks()) === 0 && $skillRank->getValue() === 0)
            && (($this->getMaxSkillRankValue() + 1) !== $skillRank->getValue())
        ) {
            throw new \LogicException(
                "New skill rank has to follow ranks sequence, expected "
                . (count($this->getSkillRanks()) === 0
                    ? '0'
                    : ($this->getMaxSkillRankValue() + 1))
                . ", got {$skillRank->getValue()}"
            );
        }

        $this->skillRanks[$skillRank->getValue()] = $skillRank;
    }

    /**
     * @return int
     */
    private function getMaxSkillRankValue()
    {
        if (!($skillRankValues = $this->getSkillRankValues())) {
            return 0;
        }

        return max($skillRankValues);
    }

    private function getSkillRankValues()
    {
        return array_map(
            function (AbstractSkillRank $skillRank) {
                return $skillRank->getValue();
            },
            $this->getSkillRanks()
        );
    }

    /**
     * @return AbstractSkillRank[]
     */
    public function getSkillRanks()
    {
        return $this->skillRanks;
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
