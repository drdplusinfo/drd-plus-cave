<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels;

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

    /**
     * @param Person $person
     * @throws Exceptions\PersonIsAlreadySet
     */
    public function setPerson(Person $person)
    {
        if ($this->person) {
            throw new Exceptions\PersonIsAlreadySet('Profession levels of Doctrine ID ' . $this->id . ' is linked with person of ID ' . $this->person->getId());
        }
        $this->person = $person;
    }

    /**
     * Get person
     *
     * @return Person
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * @return FighterLevel[]
     */
    public function getFighterLevels()
    {
        return $this->fighterLevels;
    }

    /**
     * @return PriestLevel[]
     */
    public function getPriestLevels()
    {
        return $this->priestLevels;
    }

    /**
     * @return PriestLevel[]
     */
    public function getRangerLevels()
    {
        return $this->rangerLevels;
    }

    /**
     * @return TheurgistLevel[]
     */
    public function getTheurgistLevels()
    {
        return $this->theurgistLevels;
    }

    /**
     * @return ThiefLevel[]
     */
    public function getThiefLevels()
    {
        return $this->thiefLevels;
    }

    /**
     * @return WizardLevel[]
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
        return array_merge(
            $this->getFighterLevels(),
            $this->getPriestLevels(),
            $this->getRangerLevels(),
            $this->getTheurgistLevels(),
            $this->getThiefLevels(),
            $this->getWizardLevels()
        );
    }

    /**
     * @return ProfessionLevel
     */
    public function getFirstLevel()
    {
        // TODO resolve no levels at all
        $levels = $this->getLevels();
        usort($levels, function (ProfessionLevel $aLevel, ProfessionLevel $anotherLevel) {
            $difference = $aLevel->getLevelValue() - $anotherLevel->getLevelValue();
            if ($difference === 0) {
                throw new \LogicException('Two profession levels have the same level rank.');
            }
            return $difference > 0
                ? 1
                : -1;
        });
        reset($levels);
        return current($levels);
    }

    public function addLevel(ProfessionLevel $newLevel)
    {
        // TODO check only specific profession levels
        array_walk($this->getLevels(), function (ProfessionLevel $previousLevel) use ($newLevel) {
            $this->checkLevelsRankUniqueness($newLevel, $previousLevel);
        });
        // TODO add to specific profession levels
    }

    private function checkLevelsRankUniqueness(ProfessionLevel $aLevel, ProfessionLevel $anotherLevel)
    {
        $difference = $anotherLevel->getLevelValue() - $aLevel->getLevelValue();
        if (!$difference) {
            throw new \LogicException('Two profession levels have the same level rank.');
        }
    }

    /**
     * Get strength increment
     *
     * @return int
     */
    public function getStrengthFirstLevelIncrement()
    {
        return $this->getPropertyFirstLevelIncrement(Strength::PROPERTY_CODE);
    }

    /**
     * @param string $propertyCode
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
        return $this->getPropertyFirstLevelIncrement(Agility::PROPERTY_CODE);
    }

    /**
     * Get knack increment
     *
     * @return int
     */
    public function getKnackFirstLevelIncrement()
    {
        return $this->getPropertyFirstLevelIncrement(Knack::PROPERTY_CODE);
    }

    /**
     * Get will increment
     *
     * @return int
     */
    public function getWillFirstLevelIncrement()
    {
        return $this->getPropertyFirstLevelIncrement(Will::PROPERTY_CODE);
    }

    /**
     * Get intelligence increment
     *
     * @return int
     */
    public function getIntelligenceFirstLevelIncrement()
    {
        return $this->getPropertyFirstLevelIncrement(Intelligence::PROPERTY_CODE);
    }

    /**
     * Get charisma increment
     *
     * @return int
     */
    public function getCharismaFirstLevelIncrement()
    {
        return $this->getPropertyFirstLevelIncrement(Charisma::PROPERTY_CODE);
    }

    /**
     * Get strength increment
     *
     * @return int
     */
    public function getStrengthIncrementSummary()
    {
        return $this->getPropertyIncrementSummary(Strength::PROPERTY_CODE);
    }

    /**
     * Get agility increment
     *
     * @return int
     */
    public function getAgilityIncrementSummary()
    {
        return $this->getPropertyIncrementSummary(Agility::PROPERTY_CODE);
    }

    /**
     * Get agility increment
     *
     * @return int
     */
    public function getKnackIncrementSummary()
    {
        return $this->getPropertyIncrementSummary(Knack::PROPERTY_CODE);
    }

    /**
     * Get charisma increment
     *
     * @return int
     */
    public function getCharismaIncrementSummary()
    {
        return $this->getPropertyIncrementSummary(Charisma::PROPERTY_CODE);
    }

    /**
     * Get will increment
     *
     * @return int
     */
    public function getWillIncrementSummary()
    {
        return $this->getPropertyIncrementSummary(Will::PROPERTY_CODE);
    }

    /**
     * Get intelligence increment
     *
     * @return int
     */
    public function getIntelligenceIncrementSummary()
    {
        return $this->getPropertyIncrementSummary(Intelligence::PROPERTY_CODE);
    }

    /**
     * @param string $propertyName
     * @return int
     */
    private function getPropertyIncrementSummary($propertyName)
    {
        // like getStrengthFirstLevelIncrement
        $propertyFirstLevelIncrementGetter = 'get' . ucfirst($propertyName) . 'FirstLevelIncrement';
        return $this->$propertyFirstLevelIncrementGetter() + $this->getByLevelsIncrementSummary($propertyName);
    }

    /**
     * @param string $propertyName
     * @return int
     */
    private function getByLevelsIncrementSummary($propertyName)
    {
        $byLevelsIncrementSummary = 0;
        // like getStrengthIncrement
        $propertyIncrementGetter = 'get' . ucfirst($propertyName) . 'Increment';
        $byLevelsIncrementSummary += array_sum(
            array_map(
                function (ProfessionLevel $professionLevel) use ($propertyIncrementGetter) {
                    return $professionLevel->$propertyIncrementGetter();
                },
                $this->getLevels()
            )
        );

        return $byLevelsIncrementSummary;
    }

    /**
     * Get current professions summary level
     *
     * @return int
     */
    public function getProfessionLevelsSummary()
    {
        return array_sum(
            array_map(
                function (ProfessionLevel $professionLevel) {
                    return $professionLevel->getLevelValue();
                },
                $this->getLevels()
            )
        );
    }
}
