<?php
namespace DrdPlus\Cave\UnitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\InitialProperties;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Name;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\ProfessionLevels;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Gender;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Race;
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
     * @var Gender
     *
     * @ORM\Column(type="gender")
     */
    private $gender;

    /**
     * @var Race
     *
     * @ORM\Column(type="race")
     */
    private $race;

    /**
     * @var InitialProperties
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\InitialProperties")
     */
    private $initialProperties;

    /**
     * @var ProfessionLevels
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\ProfessionLevels")
     */
    private $professionLevels;

    public function __construct(
        Gender $gender,
        Race $race,
        InitialProperties $initialProperties,
        ProfessionLevels $professionLevels
    )
    {
        $this->gender = $gender;
        $this->race = $race;
        $this->initialProperties = $initialProperties;
        $this->professionLevels = $professionLevels;
        $this->name = Name::get('');
    }

    /**
     * Get ID
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param Name $name
     * @return $this
     */
    public function setName(Name $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return Name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get race
     *
     * @return Race
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * Get gender
     *
     * @return Gender
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Get levels
     *
     * @return ProfessionLevels
     */
    public function getProfessionLevels()
    {
        return $this->professionLevels;
    }

    /**
     * @return InitialProperties
     */
    public function getInitialProperties()
    {
        return $this->initialProperties;
    }
}
