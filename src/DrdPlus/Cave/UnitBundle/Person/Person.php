<?php
namespace DrdPlus\Cave\UnitBundle\Person;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Exceptionality;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Name;
use DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\ProfessionLevels;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\InitialProperties;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Gender;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Races\Race;
use Granam\Strict\Object\StrictObject;

/**
 * Person
 *
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
     * @var InitialProperties
     *
     * @ORM\Column(type="exceptionality")
     */
    private $exceptionality;

    /**
     * @var InitialProperties
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\InitialProperties")
     */
    private $initialProperties;

    /**
     * @var ProfessionLevels
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Person\Attributes\ProfessionLevels\ProfessionLevels")
     */
    private $professionLevels;

    public function __construct(
        Race $race, // enum
        Gender $gender, // enum
        Name $name, // enum
        Exceptionality $exceptionality, // entity
        InitialProperties $initialProperties, // entity
        ProfessionLevels $professionLevels // entity
    )
    {
        $this->race = $race;
        $this->gender = $gender;
        $this->name = $name;
        $exceptionality->setPerson($this);
        $this->exceptionality = $exceptionality;
        $initialProperties->setPerson($this);
        $this->initialProperties = $initialProperties;
        $professionLevels->setPerson($this);
        $this->professionLevels = $professionLevels;
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
     * @return InitialProperties
     */
    public function getInitialProperties()
    {
        return $this->initialProperties;
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

}
