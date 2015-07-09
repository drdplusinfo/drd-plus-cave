<?php
namespace DrdPlus\Cave\UnitBundle\Person;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\TablesBundle\Tables\Tables;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Exceptionalities\Exceptionality;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Name;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Will;
use DrdPlus\Cave\UnitBundle\Person\Background\Background;
use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevels;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\PersonProperties;
use DrdPlus\Cave\UnitBundle\Person\Races\Gender;
use DrdPlus\Cave\UnitBundle\Person\Races\Race;
use DrdPlus\Cave\UnitBundle\Person\Skills\AbstractSkill;
use DrdPlus\Cave\UnitBundle\Person\Skills\AbstractSkillRank;
use DrdPlus\Cave\UnitBundle\Person\Skills\Combined\CombinedSkillPoint;
use DrdPlus\Cave\UnitBundle\Person\Skills\Physical\PhysicalSkillPoint;
use DrdPlus\Cave\UnitBundle\Person\Skills\Psychical\PsychicalSkillPoint;
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
        Skills $skills, // entity
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
        $this->checkPaymentOfSkillPoints($skills);
        $this->personProperties = new PersonProperties($this, $tables); // enums aggregate
    }

    private function checkPaymentOfSkillPoints(Skills $skills)
    {
        $nextLevelsPropertyIncreasePayment = [
            PhysicalSkillPoint::PHYSICAL => ['paymentSum' => 0, 'relatedProperties' => []],
            PsychicalSkillPoint::PSYCHICAL => ['paymentSum' => 0, 'relatedProperties' => []],
            CombinedSkillPoint::COMBINED => ['paymentSum' => 0, 'relatedProperties' => []],
        ];
        /** @var AbstractSkill $skill */
        foreach ($skills->getSkills() as $skill) {
            /** @var AbstractSkillRank $skillRank */
            foreach ($skill->getSkillRanks() as $skillRank) {
                $skillPoint = $skillRank->getSkillPoint();
                if ($skillPoint->isPaidByFirstLevelBackgroundSkills()) {
                    // TODO
                    /**
                     * there are limited first level background skills,
                     * @see \DrdPlus\Cave\UnitBundle\Person\Background\BackgroundSkills
                     * and @see \DrdPlus\Cave\UnitBundle\Person\Background\Heritage
                     * check their sum
                     */
                } else if ($skillPoint->isPaidByOtherSkillPoints()) {
                    // TODO
                    /**
                     * the other skill points have to be extracted to first level background skills, see upper
                     */
                } else if ($skillPoint->isPaidByNextLevelPropertyIncrease()) {
                    /**
                     * for every skill point of this type has to exists level property increase
                     */
                    $nextLevelsPropertyIncreasePayment[$skillPoint->getGroupName()]['paymentSum']++;
                    if (empty($nextLevelsPropertyIncreasePayment[$skillPoint->getGroupName()]['relatedProperties'])) {
                        $nextLevelsPropertyIncreasePayment[$skillPoint->getGroupName()]['relatedProperties'] = $skillPoint->getRelatedProperties();
                    }
                } else {
                    throw new \LogicException("Unknown payment for skill point of ID {$skillPoint->getId()}");
                }
            }
        }
        foreach ($nextLevelsPropertyIncreasePayment as $type => &$payment) {
            $increasedPropertySum = 0;
            $nextLevelsProperties = $this->getPersonProperties()->getNextLevelsProperties();
            foreach ($payment['relatedProperties'] as $relatedProperty) {
                switch ($relatedProperty) {
                    case Strength::STRENGTH :
                        $increasedPropertySum += $nextLevelsProperties->getStrength()->getValue();
                        break;
                    case Agility::AGILITY :
                        $increasedPropertySum += $nextLevelsProperties->getAgility()->getValue();
                        break;
                    case Knack::KNACK :
                        $increasedPropertySum += $nextLevelsProperties->getKnack()->getValue();
                        break;
                    case Will::WILL :
                        $increasedPropertySum += $nextLevelsProperties->getWill()->getValue();
                        break;
                    case Intelligence::INTELLIGENCE :
                        $increasedPropertySum += $nextLevelsProperties->getIntelligence()->getValue();
                        break;
                    case Charisma::CHARISMA :
                        $increasedPropertySum += $nextLevelsProperties->getCharisma()->getValue();
                        break;
                }
            }
            if ($payment['paymentSum'] > $increasedPropertySum) {
                throw new \LogicException(
                    "Skills from next levels of type $type have higher ranks then possible."
                    . " Max increase by next levels could be $increasedPropertySum, got " . $payment['paymentSum']
                );
            }
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
