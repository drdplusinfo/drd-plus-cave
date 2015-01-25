<?php
namespace DrdPlus\Cave\UnitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\InitialProperties;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\ProfessionLevels\ProfessionLevels;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Gender;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\Races\Race;
use Granam\StrictObject\StrictObject;

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
     * @var string
     *
     * @ORM\Column(type="string", length=255)
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
        $this->name = new \SplString('');
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
     * @param \SplString $name
     * @return $this
     */
    public function setName(\SplString $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get \SplString
     *
     * @return string
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
