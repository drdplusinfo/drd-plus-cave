<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Properties\Will;
use DrdPlus\Cave\UnitBundle\Entity\Person;
use Granam\Strict\Object\StrictObject;

/**
 * ProfessionLevels
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class ProfessionLevels extends StrictObject
{
    const PROPERTY_FIRST_LEVEL_INCREMENT = +1;

    /**
     * Value object, the ID is just for Doctrine linking
     *
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
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Person")
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

    /**
     * @param Person $person
     *
     * @throws Exceptions\PersonIsAlreadySet
     */
    public function setPerson(Person $person)
    {
        if (!$this->person) {
            $this->person = $person;
        } elseif ($this->person !== $person) {
            throw new Exceptions\PersonIsAlreadySet(
                'Profession levels of Doctrine ID ' . var_export($this->id, true)
                . ' is linked with different person (or instance) of ID ' . var_export($this->person->getId(), true) . '.'
                . ' Given person of ID ' . var_export($this->person->getId(), true) . '.'
            );
        }
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
     * @return ProfessionLevel[]|array
     */
    public function getLevels()
    {
        return array_merge(
            $this->getFighterLevels()->toArray(),
            $this->getPriestLevels()->toArray(),
            $this->getRangerLevels()->toArray(),
            $this->getTheurgistLevels()->toArray(),
            $this->getThiefLevels()->toArray(),
            $this->getWizardLevels()->toArray()
        );
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
            $difference = $aLevel->getLevelValue()->getRank() - $anotherLevel->getLevelValue()->getRank();
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
                ' ' . $this->getAlreadySetProfessionCode() . ', given  ' . $newLevel->getProfessionCode()
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
        $getterName = 'get' . ucfirst($professionLevel->getProfessionCode()) . 'Levels';

        if (!method_exists($this, $getterName)) {
            throw new \LogicException(
                'Unknown profession ' . var_export($professionLevel->getProfessionCode(), true)
            );
        }

        return $this->$getterName();
    }

    /**
     * @return string
     */
    private function getAlreadySetProfessionCode()
    {
        return array_map(
            function (ProfessionLevel $level) {
                return $level->getProfessionCode();
            },
            $this->getLevels()
        )[0];
    }

    private function checkNewLevelSequence(ProfessionLevel $newLevel, ArrayCollection $previousProfessionLevels)
    {
        if (!$newLevel->getLevelValue()->getRank()) {
            throw new \LogicException(
                'Missing level value of given level of profession ' . $newLevel->getProfessionCode() . ' with ID ' . var_export($newLevel->getId())
            );
        }

        if ($newLevel->getLevelValue()->getRank() !== ($previousProfessionLevels->count() + 1)) {
            throw new \LogicException(
                'Unexpected level of given profession level. Expected ' . ($previousProfessionLevels->count() + 1) . ', got ' . $newLevel->getLevelValue()->getRank()
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
    public function getStrengthFirstLevelIncrement()
    {
        return $this->getPropertyFirstLevelIncrement(Strength::getTypeName());
    }

    /**
     * @param string $propertyCode
     *
     * @return int
     */
    private function getPropertyFirstLevelIncrement($propertyCode)
    {
        return $this->getFirstLevel() && $this->getFirstLevel()->isMainProperty($propertyCode)
            ? self::PROPERTY_FIRST_LEVEL_INCREMENT
            : 0;
    }

    /**
     * Get agility increment
     *
     * @return int
     */
    public function getAgilityFirstLevelIncrement()
    {
        return $this->getPropertyFirstLevelIncrement(Agility::getTypeName());
    }

    /**
     * Get knack increment
     *
     * @return int
     */
    public function getKnackFirstLevelIncrement()
    {
        return $this->getPropertyFirstLevelIncrement(Knack::getTypeName());
    }

    /**
     * Get will increment
     *
     * @return int
     */
    public function getWillFirstLevelIncrement()
    {
        return $this->getPropertyFirstLevelIncrement(Will::getTypeName());
    }

    /**
     * Get intelligence increment
     *
     * @return int
     */
    public function getIntelligenceFirstLevelIncrement()
    {
        return $this->getPropertyFirstLevelIncrement(Intelligence::getTypeName());
    }

    /**
     * Get charisma increment
     *
     * @return int
     */
    public function getCharismaFirstLevelIncrement()
    {
        return $this->getPropertyFirstLevelIncrement(Charisma::getTypeName());
    }

    /**
     * Get strength increment
     *
     * @return int
     */
    public function getStrengthIncrementSummary()
    {
        return $this->getPropertyIncrementSummary(Strength::getTypeName());
    }

    /**
     * @param string $propertyName
     *
     * @return int
     */
    private function getPropertyIncrementSummary($propertyName)
    {
        // like getStrengthFirstLevelIncrement
        $propertyFirstLevelIncrementGetter = 'get' . ucfirst($propertyName) . 'FirstLevelIncrement';

        return $this->$propertyFirstLevelIncrementGetter() + $this->getLevelsPropertyIncrementSummary($propertyName);
    }

    /**
     * @param string $propertyName
     *
     * @return int
     */
    private function getLevelsPropertyIncrementSummary($propertyName)
    {
        return array_sum($this->getLevelsPropertyIncrements($propertyName));
    }

    /**
     * @param $propertyName
     * @return array|int[]
     */
    private function getLevelsPropertyIncrements($propertyName)
    {
        // strength = getStrengthIncrement
        $propertyIncrementGetter = 'get' . ucfirst($propertyName) . 'Increment';

        return array_map(
            function (ProfessionLevel $professionLevel) use ($propertyIncrementGetter) {
                return $professionLevel->$propertyIncrementGetter();
            },
            $this->getLevels()
        );
    }

    /**
     * Get agility increment
     *
     * @return int
     */
    public function getAgilityIncrementSummary()
    {
        return $this->getPropertyIncrementSummary(Agility::getTypeName());
    }

    /**
     * Get agility increment
     *
     * @return int
     */
    public function getKnackIncrementSummary()
    {
        return $this->getPropertyIncrementSummary(Knack::getTypeName());
    }

    /**
     * Get will increment
     *
     * @return int
     */
    public function getWillIncrementSummary()
    {
        return $this->getPropertyIncrementSummary(Will::getTypeName());
    }

    /**
     * Get intelligence increment
     *
     * @return int
     */
    public function getIntelligenceIncrementSummary()
    {
        return $this->getPropertyIncrementSummary(Intelligence::getTypeName());
    }

    /**
     * Get charisma increment
     *
     * @return int
     */
    public function getCharismaIncrementSummary()
    {
        return $this->getPropertyIncrementSummary(Charisma::getTypeName());
    }
}
