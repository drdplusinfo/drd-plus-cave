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
     * @var Property
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Property")
     */
    private $strengthIncrement;

    /**
     * @var Property
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Property")
     */
    private $agilityIncrement;

    /**
     * @var Property
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Property")
     */
    private $knackIncrement;

    /**
     * @var Property
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Property")
     */
    private $willIncrement;

    /**
     * @var Property
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Property")
     */
    private $intelligenceIncrement;

    /**
     * @var Property
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Property")
     */
    private $charismaIncrement;

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

    /**
     * Set strength increment
     *
     * @param Property $strengthIncrement
     * @return $this
     */
    public function setStrengthIncrement(Property $strengthIncrement)
    {
        $strengthIncrement->setLabel(Property::STRENGTH_LABEL);
        $strengthIncrement->setShortLabel(Property::STRENGTH_SHORT_LABEL);
        $this->strengthIncrement = $strengthIncrement;

        return $this;
    }

    /**
     * Get strength increment
     *
     * @return Property
     */
    public function getStrengthIncrement()
    {
        return $this->strengthIncrement;
    }

    /**
     * Set agility increment
     *
     * @param Property $agilityIncrement
     * @return $this
     */
    public function setAgilityIncrement(Property $agilityIncrement)
    {
        $agilityIncrement->setLabel(Property::AGILITY_LABEL);
        $agilityIncrement->setShortLabel(Property::AGILITY_SHORT_LABEL);
        $this->agilityIncrement = $agilityIncrement;

        return $this;
    }

    /**
     * Get agility increment
     *
     * @return Property
     */
    public function getAgilityIncrement()
    {
        return $this->agilityIncrement;
    }

    /**
     * Set charisma increment
     *
     * @param Property $charismaIncrement
     * @return self
     */
    public function setCharismaIncrement(Property $charismaIncrement)
    {
        $charismaIncrement->setLabel(Property::CHARISMA_LABEL);
        $charismaIncrement->setShortLabel(Property::CHARISMA_SHORT_LABEL);
        $this->charismaIncrement = $charismaIncrement;

        return $this;
    }

    /**
     * Get charisma increment
     *
     * @return Property
     */
    public function getCharismaIncrement()
    {
        return $this->charismaIncrement;
    }

    /**
     * Set intelligence increment
     *
     * @param Property $intelligenceIncrement
     * @return self
     */
    public function setIntelligenceIncrement(Property $intelligenceIncrement)
    {
        $intelligenceIncrement->setLabel(Property::INTELLIGENCE_LABEL);
        $intelligenceIncrement->setShortLabel(Property::INTELLIGENCE_SHORT_LABEL);
        $this->intelligenceIncrement = $intelligenceIncrement;

        return $this;
    }

    /**
     * Get intelligence increment
     *
     * @return Property
     */
    public function getIntelligenceIncrement()
    {
        return $this->intelligenceIncrement;
    }

    /**
     * @param Property $knackIncrement
     * @return self
     */
    public function setKnackIncrement(Property $knackIncrement)
    {
        $knackIncrement->setLabel(Property::KNACK_LABEL);
        $knackIncrement->setShortLabel(Property::KNACK_SHORT_LABEL);
        $this->knackIncrement = $knackIncrement;

        return $this;
    }

    /**
     * Get knack increment
     *
     * @return Property
     */
    public function getKnackIncrement()
    {
        return $this->knackIncrement;
    }

    /**
     * Set will increment
     *
     * @param Property $will
     * @return self
     */
    public function setWillIncrement(Property $will)
    {
        $will->setLabel(Property::WILL_LABEL);
        $will->setShortLabel(Property::WILL_SHORT_LABEL);
        $this->willIncrement = $will;

        return $this;
    }

    /**
     * Get will increment
     *
     * @return Property
     */
    public function getWillIncrement()
    {
        return $this->willIncrement;
    }

}
