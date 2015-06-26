<?php
namespace DrdPlus\Cave\UnitBundle\Person\ProfessionLevels;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\BaseProperty;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Body\WeightInKg;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Will;
use DrdPlus\Cave\UnitBundle\Person\Person;
use Granam\Strict\Object\StrictObject;

/**
 * ProfessionLevels
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class ProfessionLevels extends StrictObject implements \IteratorAggregate
{
    const PROPERTY_FIRST_LEVEL_MODIFIER = +1;

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
     * @var FighterLevel[]
     *
     * @ORM\OneToMany(targetEntity="FighterLevel", mappedBy="professionLevels")
     */
    private $fighterLevels;

    /**
     * @var PriestLevel[]
     *
     * @ORM\OneToMany(targetEntity="PriestLevel", mappedBy="professionLevels")
     */
    private $priestLevels;

    /**
     * @var RangerLevel[]
     *
     * @ORM\OneToMany(targetEntity="RangerLevel", mappedBy="professionLevels")
     */
    private $rangerLevels;

    /**
     * @var TheurgistLevel[]
     *
     * @ORM\OneToMany(targetEntity="TheurgistLevel", mappedBy="professionLevels")
     */
    private $theurgistLevels;

    /**
     * @var ThiefLevel[]
     *
     * @ORM\OneToMany(targetEntity="ThiefLevel", mappedBy="professionLevels")
     */
    private $thiefLevels;

    /**
     * @var WizardLevel[]
     *
     * @ORM\OneToMany(targetEntity="WizardLevel", mappedBy="professionLevels")
     */
    private $wizardLevels;

    public function __construct()
    {
        $this->fighterLevels = new ArrayCollection();
        $this->priestLevels = new ArrayCollection();
        $this->rangerLevels = new ArrayCollection();
        $this->theurgistLevels = new ArrayCollection();
        $this->thiefLevels = new ArrayCollection();
        $this->wizardLevels = new ArrayCollection();
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
    protected function getId()
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
     * @return FighterLevel[]|ArrayCollection
     */
    public function getFighterLevels()
    {
        return $this->fighterLevels;
    }

    /**
     * @return PriestLevel[]|ArrayCollection
     */
    public function getPriestLevels()
    {
        return $this->priestLevels;
    }

    /**
     * @return PriestLevel[]|ArrayCollection
     */
    public function getRangerLevels()
    {
        return $this->rangerLevels;
    }

    /**
     * @return TheurgistLevel[]|ArrayCollection
     */
    public function getTheurgistLevels()
    {
        return $this->theurgistLevels;
    }

    /**
     * @return ThiefLevel[]|ArrayCollection
     */
    public function getThiefLevels()
    {
        return $this->thiefLevels;
    }

    /**
     * @return WizardLevel[]|ArrayCollection
     */
    public function getWizardLevels()
    {
        return $this->wizardLevels;
    }

    /**
     * All levels, achieved at any profession
     *
     * @return ProfessionLevel[]
     */
    public function getLevels()
    {
        return $this->sortByLevelRank(array_merge(
            $this->getFighterLevels()->toArray(),
            $this->getPriestLevels()->toArray(),
            $this->getRangerLevels()->toArray(),
            $this->getTheurgistLevels()->toArray(),
            $this->getThiefLevels()->toArray(),
            $this->getWizardLevels()->toArray()
        ));
    }

    /**
     * @return ProfessionLevel[]
     */
    public function getIterator()
    {
        return new \ArrayObject($this->getLevels());
    }

    /**
     * @return ProfessionLevel|false
     */
    public function getFirstLevel()
    {
        $levels = $this->getLevels();
        if (count($levels) === 0) {
            return false;
        }

        return $this->sortByLevelRank($levels)[0];
    }

    /**
     * @param array|ProfessionLevel[] $professionLevels
     *
     * @return array
     */
    private function sortByLevelRank(array $professionLevels)
    {
        usort($professionLevels, function (ProfessionLevel $aLevel, ProfessionLevel $anotherLevel) {
            $difference = $aLevel->getLevelValue()->getValue() - $anotherLevel->getLevelValue()->getValue();
            if ($difference === 0) {
                throw new \LogicException(
                    'Two profession levels of IDs' .
                    ' ' . var_export($aLevel->getId(), true) . ', ' . var_export($anotherLevel->getId(), true)
                    . ' have the same level rank.'
                );
            }

            return $difference > 0
                ? 1 // firstly given level is higher than second one
                : -1; // opposite
        });

        return $professionLevels;
    }

    /**
     * Sorted by level ascending
     *
     * @return ProfessionLevel[]
     */
    public function getNextLevels()
    {
        $levels = $this->getLevels();
        $firstLevel = array_shift($levels); // remote the fist level
        /** @var ProfessionLevel $firstLevel */
        if ($firstLevel && !$firstLevel->isFirstLevel()) {
            throw new \LogicException("The removed level should be the first one, removed {$firstLevel->getLevelValue()->getValue()}");
        }

        return $levels;
    }

    /**
     * @return int
     */
    public function getNextLevelsStrengthModifier()
    {
        return $this->sumNextLevelsProperty(Strength::STRENGTH);
    }

    /**
     * @param string $propertyName
     *
     * @return int
     */
    private function sumNextLevelsProperty($propertyName)
    {
        $propertyName = implode(array_map(function($part) { return ucfirst($part);}, explode('_', $propertyName)));
        $getPropertyIncrement = "get{$propertyName}Increment";

        return (int)array_sum(
            array_map(
                function (ProfessionLevel $professionLevel) use ($getPropertyIncrement) {
                    // each level has its own property increment
                    return $professionLevel->$getPropertyIncrement();
                },
                $this->getNextLevels()
            )
        );
    }

    /**
     * @return int
     */
    public function getNextLevelsAgilityModifier()
    {
        return $this->sumNextLevelsProperty(Agility::AGILITY);
    }

    /**
     * @return int
     */
    public function getNextLevelsKnackModifier()
    {
        return $this->sumNextLevelsProperty(Knack::KNACK);
    }

    /**
     * @return int
     */
    public function getNextLevelsWillModifier()
    {
        return $this->sumNextLevelsProperty(Will::WILL);
    }

    /**
     * @return int
     */
    public function getNextLevelsIntelligenceModifier()
    {
        return $this->sumNextLevelsProperty(Intelligence::INTELLIGENCE);
    }

    /**
     * @return int
     */
    public function getNextLevelsCharismaModifier()
    {
        return $this->sumNextLevelsProperty(Charisma::CHARISMA);
    }

    /**
     * @return int
     */
    public function getNextLevelsWeightModifier()
    {
        return $this->sumNextLevelsProperty(WeightInKg::WEIGHT_IN_KG);
    }

    /**
     * @param FighterLevel $newFighterLevel
     */
    public function addFighterLevel(FighterLevel $newFighterLevel)
    {
        $this->addLevel($newFighterLevel);
    }

    /**
     * @param ProfessionLevel $newLevel
     */
    private function addLevel(ProfessionLevel $newLevel)
    {
        $previousLevels = $this->getPreviousProfessionLevels($newLevel);
        if (count($previousLevels) !== count($this->getLevels())) {
            throw new \LogicException(
                'Profession levels of ID ' . var_export($this->id, true) . ' are already set for profession' .
                ' ' . $this->getAlreadySetProfessionCode() . ', given  ' . $newLevel->getProfession()->getName()
                . ' . Multi-profession is not allowed.'
            );
        }

        $this->checkNewLevelSequence($newLevel, $previousLevels);

        $previousLevels->add($newLevel);
    }

    /**
     * @param ProfessionLevel $professionLevel
     *
     * @return ProfessionLevel[]|ArrayCollection
     */
    private function getPreviousProfessionLevels(ProfessionLevel $professionLevel)
    {
        // fighter = getFighterLevels
        $getterName = 'get' . ucfirst($professionLevel->getProfession()->getName()) . 'Levels';

        return $this->$getterName();
    }

    /**
     * @return string
     */
    private function getAlreadySetProfessionCode()
    {
        return array_map(
            function (ProfessionLevel $level) {
                return $level->getProfession()->getName();
            },
            $this->getLevels()
        )[0];
    }

    private function checkNewLevelSequence(ProfessionLevel $newLevel, ArrayCollection $previousProfessionLevels)
    {
        if (!$newLevel->getLevelValue()->getValue()) {
            throw new \LogicException(
                'Missing level value of given level of profession ' . $newLevel->getProfession()->getName() . ' with ID ' . var_export($newLevel->getId(), true)
            );
        }

        if ($newLevel->getLevelValue()->getValue() !== ($previousProfessionLevels->count() + 1)) {
            throw new \LogicException(
                'Unexpected level of given profession level. Expected ' . ($previousProfessionLevels->count() + 1) . ', got ' . $newLevel->getLevelValue()->getValue()
            );
        }
    }

    /**
     * @param PriestLevel $newPriestLevel
     */
    public function addPriestLevel(PriestLevel $newPriestLevel)
    {
        $this->addLevel($newPriestLevel);
    }

    /**
     * @param RangerLevel $newRangerLevel
     */
    public function addRangerLevel(RangerLevel $newRangerLevel)
    {
        $this->addLevel($newRangerLevel);
    }

    /**
     * @param TheurgistLevel $newTheurgistLevel
     */
    public function addTheurgistLevel(TheurgistLevel $newTheurgistLevel)
    {
        $this->addLevel($newTheurgistLevel);
    }

    /**
     * @param ThiefLevel $newThiefLevel
     */
    public function addThiefLevel(ThiefLevel $newThiefLevel)
    {
        $this->addLevel($newThiefLevel);
    }

    /**
     * @param WizardLevel $newWizardLevel
     */
    public function addWizardLevel(WizardLevel $newWizardLevel)
    {
        $this->addLevel($newWizardLevel);
    }

    /**
     * Get strength increment
     *
     * @return int
     */
    public function getStrengthModifierForFirstLevel()
    {
        return $this->hasFirstLevel()
            ? $this->getFirstLevel()->getStrengthIncrement()->getValue()
            : 0;
    }

    /**
     * @return bool
     */
    private function hasFirstLevel()
    {
        return count($this->getLevels()) > 0;
    }

    /**
     * Get agility modifier
     *
     * @return int
     */
    public function getAgilityModifierForFirstLevel()
    {
        return $this->hasFirstLevel()
            ? $this->getFirstLevel()->getAgilityIncrement()->getValue()
            : 0;
    }

    /**
     * Get knack modifier
     *
     * @return int
     */
    public function getKnackModifierForFirstLevel()
    {
        return $this->hasFirstLevel()
            ? $this->getFirstLevel()->getKnackIncrement()->getValue()
            : 0;
    }

    /**
     * Get will modifier
     *
     * @return int
     */
    public function getWillModifierForFirstLevel()
    {
        return $this->hasFirstLevel()
            ? $this->getFirstLevel()->getWillIncrement()->getValue()
            : 0;
    }

    /**
     * Get intelligence modifier
     *
     * @return int
     */
    public function getIntelligenceModifierForFirstLevel()
    {
        return $this->hasFirstLevel()
            ? $this->getFirstLevel()->getIntelligenceIncrement()->getValue()
            : 0;
    }

    /**
     * Get charisma modifier
     *
     * @return int
     */
    public function getCharismaModifierForFirstLevel()
    {
        return $this->hasFirstLevel()
            ? $this->getFirstLevel()->getCharismaIncrement()->getValue()
            : 0;
    }

    /**
     * Get weight modifier in kg
     *
     * @return int
     */
    public function getWeightKgModifierForFirstLevel()
    {
        return $this->hasFirstLevel()
            ? $this->getFirstLevel()->getWeightInKgIncrement()->getValue()
            : 0;
    }

    /**
     * Get strength modifier
     *
     * @return int
     */
    public function getStrengthModifierSummary()
    {
        return $this->getPropertyModifierSummary(Strength::STRENGTH);
    }

    /**
     * @param string $propertyName
     *
     * @return int
     */
    private function getPropertyModifierSummary($propertyName)
    {
        // like getStrengthIncrement()->getValue
        $getPropertyModifierForFirstLevel = 'get' . ucfirst($propertyName) . 'ModifierForFirstLevel';

        return $this->$getPropertyModifierForFirstLevel() + $this->getNextLevelsPropertyModifierSummary($propertyName);
    }

    /**
     * @param string $propertyName
     *
     * @return int
     */
    private function getNextLevelsPropertyModifierSummary($propertyName)
    {
        return array_sum($this->getNextLevelsPropertyModifiers($propertyName));
    }

    /**
     * @param $propertyName
     *
     * @return array|int[]
     */
    private function getNextLevelsPropertyModifiers($propertyName)
    {
        /** like strength = getStrengthModifier, @see ProfessionLevel::getStrengthModifier() */
        $getPropertyIncrement = 'get' . ucfirst($propertyName) . 'Increment';

        return array_map(
            function (ProfessionLevel $professionLevel) use ($getPropertyIncrement) {
                /** @var BaseProperty $propertyIncrement */
                $propertyIncrement = $professionLevel->$getPropertyIncrement();

                return $propertyIncrement->getValue();
            },
            $this->getNextLevels()
        );
    }

    /**
     * Get agility modifier
     *
     * @return int
     */
    public function getAgilityModifierSummary()
    {
        return $this->getPropertyModifierSummary(Agility::AGILITY);
    }

    /**
     * Get agility modifier
     *
     * @return int
     */
    public function getKnackModifierSummary()
    {
        return $this->getPropertyModifierSummary(Knack::KNACK);
    }

    /**
     * Get will modifier
     *
     * @return int
     */
    public function getWillModifierSummary()
    {
        return $this->getPropertyModifierSummary(Will::WILL);
    }

    /**
     * Get intelligence modifier
     *
     * @return int
     */
    public function getIntelligenceModifierSummary()
    {
        return $this->getPropertyModifierSummary(Intelligence::INTELLIGENCE);
    }

    /**
     * Get charisma modifier
     *
     * @return int
     */
    public function getCharismaModifierSummary()
    {
        return $this->getPropertyModifierSummary(Charisma::CHARISMA);
    }

    /**
     * @return int
     */
    public function getNextLevelsStrengthSummary()
    {
        return $this->getNextLevelsPropertyModifierSummary(Strength::STRENGTH);
    }

    /**
     * @return int
     */
    public function getNextLevelsAgilitySummary()
    {
        return $this->getNextLevelsPropertyModifierSummary(Agility::AGILITY);
    }

    /**
     * @return int
     */
    public function getNextLevelsKnackSummary()
    {
        return $this->getNextLevelsPropertyModifierSummary(Knack::KNACK);
    }

    /**
     * @return int
     */
    public function getNextLevelsWillSummary()
    {
        return $this->getNextLevelsPropertyModifierSummary(Will::WILL);
    }

    /**
     * @return int
     */
    public function getNextLevelsIntelligenceSummary()
    {
        return $this->getNextLevelsPropertyModifierSummary(Intelligence::INTELLIGENCE);
    }

    /**
     * @return int
     */
    public function getNextLevelsCharismaSummary()
    {
        return $this->getNextLevelsPropertyModifierSummary(Charisma::CHARISMA);
    }
}
