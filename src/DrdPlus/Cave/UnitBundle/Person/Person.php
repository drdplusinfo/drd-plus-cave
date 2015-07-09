<?php
namespace DrdPlus\Cave\UnitBundle\Person;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\TablesBundle\Tables\Tables;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Exceptionality;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Name;
use DrdPlus\Cave\UnitBundle\Person\Background\Background;
use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevels;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\PersonProperties;
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
        ProfessionLevels $professionLevels, // entity
        Background $background, // entity
        Skills $skills,
        Tables $tables // data helper
    )
    {
        $this->race = $race;
        $this->gender = $gender;
        $this->name = $name;
        $this->exceptionality = $exceptionality;
        $this->professionLevels = $professionLevels;
        $this->background = $background;
        $this->skills = $skills;
        $this->personProperties = new PersonProperties($this, $tables); // enums aggregate
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
