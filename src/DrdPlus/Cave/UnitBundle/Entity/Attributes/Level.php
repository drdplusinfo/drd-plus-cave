<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\LevelOfProfession\FighterLevel;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\LevelOfProfession\PriestLevel;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\LevelOfProfession\RangerLevel;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\LevelOfProfession\TheurgistLevel;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\LevelOfProfession\ThiefLevel;
use DrdPlus\Cave\UnitBundle\Entity\Attributes\LevelOfProfession\WizardLevel;
use DrdPlus\Cave\UnitBundle\Entity\Person;

/**
 * Level
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Level
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
     * @var Person
     *
     * @ORM\ManyToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Person", inversedBy="levels")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $person;

    /**
     * @var FighterLevel
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\LevelOfProfession\FighterLevel")
     */
    private $fighterLevel;

    /**
     * @var PriestLevel
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\LevelOfProfession\PriestLevel")
     */
    private $priestLevel;

    /**
     * @var RangerLevel
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\LevelOfProfession\RangerLevel")
     */
    private $rangerLevel;

    /**
     * @var TheurgistLevel
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\LevelOfProfession\TheurgistLevel")
     */
    private $theurgistLevel;

    /**
     * @var ThiefLevel
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\LevelOfProfession\ThiefLevel")
     */
    private $thiefLevel;

    /**
     * @var WizardLevel
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\LevelOfProfession\WizardLevel")
     */
    private $wizardLevel;

    /**
     * @var integer
     *
     * @ORM\Column(type="smallint")
     */
    private $characterLevel;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set person
     *
     * @param Person $person
     * @return $this
     */
    public function setPerson(Person $person)
    {
        $this->person = $person;

        return $this;
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
     * Set fighter level
     *
     * @param FighterLevel $fighterLevel
     * @return $this
     */
    public function setFighterLevel(FighterLevel $fighterLevel)
    {
        $this->fighterLevel = $fighterLevel;

        return $this;
    }

    /**
     * Get fighter level
     *
     * @return FighterLevel
     */
    public function getFighterLevel()
    {
        return $this->fighterLevel;
    }

    /**
     * Set priest level
     *
     * @param PriestLevel $priestLevel
     * @return $this
     */
    public function setPriestLevel(PriestLevel $priestLevel)
    {
        $this->priestLevel = $priestLevel;

        return $this;
    }

    /**
     * Get priest level
     *
     * @return PriestLevel
     */
    public function getPriestLevel()
    {
        return $this->person;
    }

    /**
     * Set person
     *
     * @param RangerLevel $rangerLevel
     * @return $this
     */
    public function setRangerLevel(RangerLevel $rangerLevel)
    {
        $this->rangerLevel = $rangerLevel;

        return $this;
    }

    /**
     * Get ranger level
     *
     * @return RangerLevel
     */
    public function getRangerLevel()
    {
        return $this->rangerLevel;
    }

    /**
     * Set theurgist level
     *
     * @param TheurgistLevel $theurgistLevel
     * @return $this
     */
    public function setTheurgistLevel(TheurgistLevel $theurgistLevel)
    {
        $this->theurgistLevel = $theurgistLevel;

        return $this;
    }

    /**
     * Get theurgist level
     *
     * @return TheurgistLevel
     */
    public function getTheurgistLevel()
    {
        return $this->theurgistLevel;
    }

    /**
     * Set thief level
     *
     * @param ThiefLevel $thiefLevel
     * @return $this
     */
    public function setThiefLevel(ThiefLevel $thiefLevel)
    {
        $this->thiefLevel = $thiefLevel;

        return $this;
    }

    /**
     * Get thief level
     *
     * @return ThiefLevel
     */
    public function getThiefLevel()
    {
        return $this->thiefLevel;
    }

    /**
     * Set wizard level
     *
     * @param WizardLevel $wizardLevel
     * @return $this
     */
    public function setWizardLevel(WizardLevel $wizardLevel)
    {
        $this->wizardLevel = $wizardLevel;

        return $this;
    }

    /**
     * Get wizard level
     *
     * @return WizardLevel
     */
    public function getWizardLevel()
    {
        return $this->person;
    }

    /**
     * Set character level
     *
     * @param integer $characterLevel
     * @return $this
     */
    public function setCharacterLevel($characterLevel)
    {
        $this->characterLevel = $characterLevel;

        return $this;
    }

    /**
     * Get character level
     *
     * @return int
     */
    public function getCharacterLevel()
    {
        return $this->characterLevel;
    }

}
