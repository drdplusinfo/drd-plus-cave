<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills;

use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\NextLevelsProperties;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Will;
use DrdPlus\Cave\UnitBundle\Person\Background\BackgroundSkills;
use DrdPlus\Cave\UnitBundle\Person\Person;
use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevels;
use DrdPlus\Cave\UnitBundle\Person\Skills\Combined\CombinedSkillPoint;
use DrdPlus\Cave\UnitBundle\Person\Skills\Combined\CombinedSkills;
use DrdPlus\Cave\UnitBundle\Person\Skills\Physical\PhysicalSkillPoint;
use DrdPlus\Cave\UnitBundle\Person\Skills\Physical\PhysicalSkills;
use DrdPlus\Cave\UnitBundle\Person\Skills\Psychical\PsychicalSkillPoint;
use DrdPlus\Cave\UnitBundle\Person\Skills\Psychical\PsychicalSkills;
use Granam\Strict\Object\StrictObject;

/**
 * Skills
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Skills extends StrictObject
{
    const PHYSICAL = PhysicalSkills::PHYSICAL;
    const PSYCHICAL = PsychicalSkills::PSYCHICAL;
    const COMBINED = CombinedSkills::COMBINED;

    const PROPERTY_TO_SKILL_POINT_MULTIPLIER = 1; // each point of property gives one skill point

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var PhysicalSkills
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Person\Skills\Physical\PhysicalSkills")
     */
    private $physicalSkills;

    /**
     * @var PsychicalSkills
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Person\Skills\Psychical\PsychicalSkills")
     */
    private $psychicalSkills;

    /**
     * @var CombinedSkills
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Person\Skills\Combined\CombinedSkills")
     */
    private $combinedSkills;

    public function __construct(
        PhysicalSkills $physicalSkills,
        PsychicalSkills $psychicalSkills,
        CombinedSkills $combinedSkills
    )
    {
        $this->physicalSkills = $physicalSkills;
        $this->psychicalSkills = $psychicalSkills;
        $this->combinedSkills = $combinedSkills;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return PhysicalSkills
     */
    public function getPhysicalSkills()
    {
        return $this->physicalSkills;
    }

    /**
     * @return PsychicalSkills
     */
    public function getPsychicalSkills()
    {
        return $this->psychicalSkills;
    }

    /**
     * @return CombinedSkills
     */
    public function getCombinedSkills()
    {
        return $this->combinedSkills;
    }

    /**
     * @return array|AbstractSkill[]
     */
    public function getSkills()
    {
        return array_merge(
            $this->getPhysicalSkills()->getSkills(),
            $this->getPsychicalSkills()->getSkills(),
            $this->getCombinedSkills()->getSkills()
        );
    }

    /**
     * @return int
     */
    public function getFreeFirstLevelPhysicalSkillPointsValue()
    {
        // TODO
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @return int
     */
    public function getFreeNextLevelsPhysicalSkillPointsValue(ProfessionLevels $professionLevels)
    {
        $nextLevelsPhysicalPropertiesSum = $this->getNextLevelsPhysicalPropertiesSum($professionLevels);

        return $this->getFreeNextLevelsSkillPointsValue($nextLevelsPhysicalPropertiesSum, $this->getPhysicalSkills());
    }

    private function getNextLevelsPhysicalPropertiesSum(ProfessionLevels $professionLevels)
    {
        return $professionLevels->getNextLevelsAgilityModifier() + $professionLevels->getNextLevelsStrengthModifier();
    }

    /**
     * @param int $nextLevelsPropertiesSum as potential of skill points
     * @param AbstractSkillsGroup $thisGroup
     *
     * @return int
     */
    private function getFreeNextLevelsSkillPointsValue(
        $nextLevelsPropertiesSum,
        AbstractSkillsGroup $thisGroup
    )
    {
        return $nextLevelsPropertiesSum - $thisGroup->getNextLevelsSkillRankSummary();
    }

    /**
     * @return int
     */
    public function getFreeFirstLevelPsychicalSkillPointsValue()
    {
        // TODO
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @return int
     */
    public function getFreeNextLevelsPsychicalSkillPointsValue(ProfessionLevels $professionLevels)
    {
        $nextLevelsPsychicalPropertiesSum = $this->getNextLevelsPsychicalPropertiesSum($professionLevels);

        return $this->getFreeNextLevelsSkillPointsValue($nextLevelsPsychicalPropertiesSum, $this->getPsychicalSkills());
    }

    private function getNextLevelsPsychicalPropertiesSum(ProfessionLevels $professionLevels)
    {
        return $professionLevels->getNextLevelsIntelligenceModifier() + $professionLevels->getNextLevelsWillModifier();
    }

    /**
     * @return int
     */
    public function getFreeFirstLevelCombinedSkillPointsValue()
    {
        // TODO
    }

    /**
     * @param ProfessionLevels $professionLevels
     *
     * @return int
     */
    public function getFreeNextLevelsCombinedSkillPointsValue(ProfessionLevels $professionLevels)
    {
        $nextLevelsCombinedPropertiesSum = $this->getNextLevelsCombinedPropertiesSum($professionLevels);

        return $this->getFreeNextLevelsSkillPointsValue($nextLevelsCombinedPropertiesSum, $this->getCombinedSkills());
    }

    private function getNextLevelsCombinedPropertiesSum(ProfessionLevels $professionLevels)
    {
        return $professionLevels->getNextLevelsKnackModifier() + $professionLevels->getNextLevelsCharismaModifier();
    }

    public function checkPaymentOfSkillPoints(Person $person)
    {
        $propertyPayments = $this->getPaymentSkeleton();

        /** @var AbstractSkill $skill */
        foreach ($this->getSkills() as $skill) {
            /** @var AbstractSkillRank $skillRank */
            foreach ($skill->getSkillRanks() as $skillRank) {
                $paymentDetails = $this->extractPaymentDetails($skillRank->getSkillPoint());
                $propertyPayments = $this->sumPayments([$propertyPayments, $paymentDetails]);
            }
        }

        $this->checkFirstLevelPayment($propertyPayments['firstLevel'], $person);
        $this->checkNextLevelsPayment($propertyPayments['nextLevels'], $person->getPersonProperties()->getNextLevelsProperties());
    }

    private function getPaymentSkeleton()
    {
        return [
            'firstLevel' => $this->getFirstLevelPaymentSkeleton(),
            'nextLevels' => $this->getNextLevelsPaymentSkeleton()
        ];
    }

    private function getNextLevelsPaymentSkeleton()
    {
        return [
            PhysicalSkillPoint::PHYSICAL => ['paymentSum' => 0, 'relatedProperties' => []],
            PsychicalSkillPoint::PSYCHICAL => ['paymentSum' => 0, 'relatedProperties' => []],
            CombinedSkillPoint::COMBINED => ['paymentSum' => 0, 'relatedProperties' => []]
        ];
    }

    private function getFirstLevelPaymentSkeleton()
    {
        return [
            PhysicalSkillPoint::PHYSICAL => ['paymentSum' => 0, 'backgroundSkills' => null],
            PsychicalSkillPoint::PSYCHICAL => ['paymentSum' => 0, 'backgroundSkills' => null],
            CombinedSkillPoint::COMBINED => ['paymentSum' => 0, 'backgroundSkills' => null]
        ];
    }

    private function extractPaymentDetails(AbstractSkillPoint $skillPoint)
    {
        $propertyPayment = $this->getPaymentSkeleton();

        $type = $skillPoint->getTypeName();
        if ($skillPoint->isPaidByFirstLevelBackgroundSkills()) {
            /**
             * there are limited first level background skills,
             * @see \DrdPlus\Cave\UnitBundle\Person\Background\BackgroundSkills
             * and @see \DrdPlus\Cave\UnitBundle\Person\Background\Heritage
             * check their sum
             */
            $propertyPayment['firstLevel'][$type]['paymentSum']++;
            $propertyPayment['firstLevel'][$type]['backgroundSkills'] = $skillPoint->getBackgroundSkills(); // one to one

            return $propertyPayment;
        } else if ($skillPoint->isPaidByOtherSkillPoints()) {
            $firstPaidOtherSkillPoint = $this->extractPaymentDetails($skillPoint->getFirstPaidOtherSkillPoint());
            $secondPaidOtherSkillPoint = $this->extractPaymentDetails($skillPoint->getSecondPaidOtherSkillPoint());

            return $this->sumPayments([$firstPaidOtherSkillPoint, $secondPaidOtherSkillPoint]);
            /**
             * the other skill points have to be extracted to first level background skills, see upper
             */
        } else if ($skillPoint->isPaidByNextLevelPropertyIncrease()) {
            /**
             * for every skill point of this type has to exists level property increase
             */
            $propertyPayment['nextLevels'][$type]['paymentSum']++;
            $propertyPayment['nextLevels'][$type]['relatedProperties'] = $skillPoint->getRelatedProperties();

            return $propertyPayment;
        } else {
            throw new \LogicException("Unknown payment for skill point of ID {$skillPoint->getId()}");
        }
    }

    /**
     * @param array $skillPointPayments
     * @return array
     */
    private function sumPayments(array $skillPointPayments)
    {
        $sumPayment = $this->getPaymentSkeleton();

        foreach ($skillPointPayments as $skillPointPayment) {
            foreach ([PhysicalSkillPoint::PHYSICAL, PsychicalSkillPoint::PSYCHICAL, CombinedSkillPoint::COMBINED] as $type) {
                $sumPayment = $this->sumFirstLevelPaymentForType($sumPayment, $skillPointPayment, $type);
                $sumPayment = $this->sumNextLevelsPaymentForType($sumPayment, $skillPointPayment, $type);
            }
        }

        return $sumPayment;
    }

    /**
     * @param array $sumPayment
     * @param array $skillPointPayment
     * @param string $type
     * @return array
     */
    private function sumFirstLevelPaymentForType(array $sumPayment, array $skillPointPayment, $type)
    {
        $sumPaymentOfType = &$sumPayment['firstLevel'][$type];
        $skillPointPaymentOfType = $skillPointPayment['firstLevel'][$type];

        $sumPaymentOfType['paymentSum'] += $skillPointPaymentOfType['paymentSum'];
        if (!$sumPaymentOfType['backgroundSkills']) {
            if ($skillPointPaymentOfType['backgroundSkills']) {
                $sumPaymentOfType['backgroundSkills'] = $skillPointPaymentOfType['backgroundSkills'];
            }
        } else if ($skillPointPaymentOfType['backgroundSkills']) {
            /** @var BackgroundSkills $skillPointPaymentBackgroundSkills */
            $skillPointPaymentBackgroundSkills = $skillPointPaymentOfType['backgroundSkills'];
            /** @var BackgroundSkills $sumPaymentBackgroundSkills */
            $sumPaymentBackgroundSkills = $sumPaymentOfType['backgroundSkills'];
            if ($skillPointPaymentBackgroundSkills->getBackgroundPointsValue() !== $sumPaymentBackgroundSkills->getBackgroundPointsValue()) {
                throw new \LogicException(
                    "All skill points, originated in background skills, have to use same background."
                    . " Got background skills with value {$skillPointPaymentBackgroundSkills->getBackgroundPointsValue()} and {$sumPaymentBackgroundSkills->getBackgroundPointsValue()}"
                );
            }
        }

        return $sumPayment;
    }

    private function sumNextLevelsPaymentForType(array $sumPayment, array $skillPointPayment, $type)
    {
        $sumPaymentOfType = &$sumPayment['nextLevels'][$type];
        $skillPointPaymentOfType = $skillPointPayment['nextLevels'][$type];

        $sumPaymentOfType['paymentSum'] += $skillPointPaymentOfType['paymentSum'];
        if (!$sumPaymentOfType['relatedProperties']) {
            if ($skillPointPaymentOfType['relatedProperties']) {
                $sumPaymentOfType['relatedProperties'] = $skillPointPaymentOfType['relatedProperties'];
            }
        } else if ($skillPointPaymentOfType['relatedProperties']) {
            /** @var string[] $skillPointRelatedProperties */
            $skillPointRelatedProperties = $skillPointPaymentOfType['relatedProperties'];
            /** @var string[] $sumPaymentRelatedProperties */
            $sumPaymentRelatedProperties = $sumPaymentOfType['relatedProperties'];
            if ($skillPointRelatedProperties !== $sumPaymentRelatedProperties) {
                throw new \LogicException(
                    "All next level skill points of same type ($type) have to use same related properties."
                    . ' Got ' . implode(',', $skillPointRelatedProperties) . ' and ' . implode(',', $sumPaymentRelatedProperties)
                );
            }
        }

        return $sumPayment;
    }

    private function checkFirstLevelPayment(array $firstLevelPayment, Person $person)
    {
        $backgroundSkills = $person->getBackground()->getBackgroundSkills();
        foreach ($firstLevelPayment as $type => $payment) {
            if (!$payment['backgroundSkills']) {
                throw new \LogicException("Background skills are missing for first level payment of type $type");
            }
            /** @var BackgroundSkills $paymentBackgroundSkills */
            $paymentBackgroundSkills = $payment['backgroundSkills'];
            if ($paymentBackgroundSkills->getBackgroundPointsValue() !== $backgroundSkills->getBackgroundPointsValue()) {
                throw new \LogicException(
                    "Background skills of current skills with value {$paymentBackgroundSkills->getBackgroundPointsValue()}"
                    . " are different to person background skills with value {$backgroundSkills->getBackgroundPointsValue()}"
                );
            }
            $availableSkillPoints = 0;
            switch ($type) {
                case self::PHYSICAL :
                    $availableSkillPoints = $backgroundSkills->getPhysicalSkillPoints($person->getProfessionLevels()->getFirstLevel()->getProfession());
                    break;
                case self::PSYCHICAL :
                    $availableSkillPoints = $backgroundSkills->getPsychicalSkillPoints($person->getProfessionLevels()->getFirstLevel()->getProfession());
                    break;
                case self::COMBINED :
                    $availableSkillPoints = $backgroundSkills->getCombinedSkillPoints($person->getProfessionLevels()->getFirstLevel()->getProfession());
                    break;
            }
            if ($availableSkillPoints < $payment['paymentSum']) {
                throw new \LogicException(
                    "First level skills of type $type have higher ranks then possible."
                    . " Expected spent $availableSkillPoints skill points at most, counted " . $payment['paymentSum']
                );
            }
        }
    }

    private function checkNextLevelsPayment(array $nextLevelsPayment, NextLevelsProperties $nextLevelsProperties)
    {
        foreach ($nextLevelsPayment as $type => $payment) {
            $increasedPropertySum = 0;
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
            if ($payment['paymentSum'] > $this->getSkillPointValueByPropertyIncrease($increasedPropertySum)) {
                throw new \LogicException(
                    "Skills from next levels of type $type have higher ranks then possible."
                    . " Max increase by next levels could be $increasedPropertySum, got " . $payment['paymentSum']
                );
            }
        }
    }

    /**
     * @param int $propertyIncrease
     * @return int
     */
    public function getSkillPointValueByPropertyIncrease($propertyIncrease)
    {
        return self::PROPERTY_TO_SKILL_POINT_MULTIPLIER * $propertyIncrease;
    }

}
