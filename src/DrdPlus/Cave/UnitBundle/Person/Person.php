<?php
namespace DrdPlus\Cave\UnitBundle\Person;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\TablesBundle\Tables\Experiences\ExperiencesTable;
use DrdPlus\Cave\TablesBundle\Tables\Tables;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Exceptionality;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Experiences;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Name;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\PersonProperties;
use DrdPlus\Cave\UnitBundle\Person\Background\Background;
use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevels;
use DrdPlus\Cave\UnitBundle\Person\Races\Gender;
use DrdPlus\Cave\UnitBundle\Person\Races\Race;
use DrdPlus\Cave\UnitBundle\Person\Skills\Skills;
use Granam\Strict\Object\StrictObject;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class Person extends StrictObject
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Name
     *
     * @ORM\Column(type="name")
     */
    private $name;

    /**
     * @var Race
     *
     * @ORM\Column(type="race")
     */
    private $race;

    /**
     * @var Gender
     *
     * @ORM\Column(type="gender")
     */
    private $gender;

    /**
     * @var Exceptionality
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Exceptionality")
     */
    private $exceptionality;

    /**
     * @var PersonProperties
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\PersonProperties")
     */
    private $personProperties;

    /**
     * @var ProfessionLevels
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevels")
     */
    private $professionLevels;

    /**
     * @var Experiences
     *
     * @ORM\Column(type="experiences")
     */
    private $experiences;

    /**
     * @var Background
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Person\Background\Background")
     */
    private $background;

    /**
     * @var Skills
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Person\Skills\Skills")
     */
    private $skills;

    public function __construct(
        Race $race, // enum
        Gender $gender, // enum
        Name $name, // enum
        Exceptionality $exceptionality, // entity
        Experiences $experiences, // enum
        ProfessionLevels $professionLevels, // entity
        Background $background, // entity
        Skills $skills, // entity
        Tables $tables // data helper
    )
    {
        $this->race = $race;
        $this->gender = $gender;
        $this->name = $name;
        $this->exceptionality = $exceptionality;
        $this->checkLevelsAgainstExperiences($professionLevels, $experiences, $tables->getExperiencesTable());
        $this->professionLevels = $professionLevels;
        $this->experiences = $experiences;
        $this->background = $background;
        $this->personProperties = new PersonProperties( // enums aggregate
            $this->getRace(),
            $this->getGender(),
            $this->getExceptionality()->getExceptionalityProperties(),
            $this->getProfessionLevels(),
            $tables
        );
        $skills->checkSkillPoints(
            $this->getProfessionLevels()->getFirstLevel(),
            $this->getBackground()->getBackgroundSkills(),
            $this->getPersonProperties()->getNextLevelsProperties()
        );
        $this->skills = $skills;
    }

    private function checkLevelsAgainstExperiences(
        ProfessionLevels $professionLevels,
        Experiences $experiences,
        ExperiencesTable $experiencesTable
    )
    {
        $highestLevel = $professionLevels->getHighestLevelRank()->getValue();
        $requiredExperiences = $experiencesTable->levelToTotalExperiences($highestLevel);
        if ($experiences->getValue() < $requiredExperiences) {
            throw new \LogicException(
                "Given level $highestLevel needs at least $requiredExperiences, got only {$experiences->getValue()}"
            );
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
     * Name is an enum, therefore de facto a constant, therefore only way how to change the name is to replace it
     *
     * @param Name $name
     *
     * @return $this
     */
    public function setName(Name $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Race
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * @return Gender
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @return PersonProperties
     */
    public function getPersonProperties()
    {
        return $this->personProperties;
    }

    /**
     * @return Exceptionality
     */
    public function getExceptionality()
    {
        return $this->exceptionality;
    }

    /**
     * @return Experiences
     */
    public function getExperiences()
    {
        return $this->experiences;
    }

    /**
     * @return ProfessionLevels
     */
    public function getProfessionLevels()
    {
        return $this->professionLevels;
    }

    /**
     * @return Background
     */
    public function getBackground()
    {
        return $this->background;
    }

    /**
     * @return Skills
     */
    public function getSkills()
    {
        return $this->skills;
    }

}
