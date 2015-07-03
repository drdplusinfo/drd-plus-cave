<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills;

use Doctrine\ORM\Mapping as ORM;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Agility;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Charisma;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Intelligence;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Knack;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Strength;
use DrdPlus\Cave\UnitBundle\Person\Attributes\Properties\Will;
use DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevel;
use Granam\Integer\IntegerInterface;
use Granam\Strict\Object\StrictObject;

abstract class AbstractSkillPoint extends StrictObject implements IntegerInterface
{
    const SKILL_POINT_VALUE = 1;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @return string
     */
    abstract public function getGroupName();

    /**
     * @return string[]
     */
    abstract public function getRelatedProperties();

    /**
     * @var ProfessionLevel
     *
     * @ORM\OneToOne(target="\DrdPlus\Cave\UnitBundle\Person\ProfessionLevels\ProfessionLevel")
     */
    private $professionLevel;

    /**
     * @var AbstractSkillPoint|null
     *
     * @ORM\OneToOne(targetEntity="\DrdPlus\Cave\UnitBundle\Person\Skills\AbstractSkillPoint")
     */
    private $firstPaidSkillPoint;

    /**
     * @var AbstractSkillPoint|null
     *
     * @ORM\OneToOne(targetEntity="\DrdPlus\Cave\UnitBundle\Person\Skills\AbstractSkillPoint")
     */
    private $secondPaidSkillPoint;

    /**
     * @param ProfessionLevel $professionLevel
     * @param AbstractSkillPoint $firstPaidSkillPoint = null
     * @param AbstractSkillPoint $secondPaidSkillPoint = null
     */
    protected function __construct(ProfessionLevel $professionLevel, AbstractSkillPoint $firstPaidSkillPoint = null, AbstractSkillPoint $secondPaidSkillPoint = null)
    {
        $this->checkPayBySkillPoints($firstPaidSkillPoint, $firstPaidSkillPoint);
        $this->checkPayByLevelPropertiesIncrease($professionLevel, $firstPaidSkillPoint, $secondPaidSkillPoint);
        $this->professionLevel = $professionLevel;
        $this->firstPaidSkillPoint = $firstPaidSkillPoint;
        $this->secondPaidSkillPoint = $secondPaidSkillPoint;
    }

    protected function checkPayBySkillPoints(AbstractSkillPoint $firstPaidSkillPoint = null, AbstractSkillPoint $secondPaidSkillPoint = null)
    {
        if ((!$firstPaidSkillPoint && $secondPaidSkillPoint) || ($firstPaidSkillPoint && !$secondPaidSkillPoint)) {
            throw new \LogicException(
                'You can not pay by just a single skill point, the price is two skill points'
            );
        }
        $this->checkPaidSkillPoint($firstPaidSkillPoint);
        $this->checkPaidSkillPoint($secondPaidSkillPoint);
    }

    protected function checkPaidSkillPoint(AbstractSkillPoint $skillPoint)
    {
        if ($skillPoint->getGroupName() === $this->getGroupName()) {
            throw new \LogicException(
                'There is no sense to pay for skill point by another one of the very same type. Got paid skill point of ID ' . $skillPoint->getId()
            );
        }
    }

    protected function checkPayByLevelPropertiesIncrease(ProfessionLevel $professionLevel, AbstractSkillPoint $firstPaidSkillPoint = null, AbstractSkillPoint $secondPaidSkillPoint = null)
    {
        if ($firstPaidSkillPoint && $secondPaidSkillPoint) {
            return true; // the skill point has been paid by another skill points
        }

        $relatedProperties = $this->sortAlphabetically($this->getRelatedProperties());
        $missingPropertyIncrement = false;
        switch ($relatedProperties) {
            case $this->sortAlphabetically([Strength::STRENGTH, Agility::AGILITY]) :
                $missingPropertyIncrement = !$professionLevel->getStrengthIncrement()->getValue() && !$professionLevel->getAgilityIncrement()->getValue();
                break;
            case $this->sortAlphabetically([Will::WILL, Intelligence::INTELLIGENCE]) :
                $missingPropertyIncrement = !$professionLevel->getWillIncrement()->getValue() && !$professionLevel->getIntelligenceIncrement()->getValue();
                break;
            case $this->sortAlphabetically([Knack::KNACK, Charisma::CHARISMA]) :
                $missingPropertyIncrement = !$professionLevel->getKnackIncrement()->getValue() && !$professionLevel->getCharismaIncrement()->getValue();
                break;
        }

        if ($missingPropertyIncrement) {
            throw new \LogicException(
                'The profession level of ID ' . $professionLevel->getId() . ' has to have incremented either ' . implode(' or ', $this->getRelatedProperties())
            );
        }

        return true;
    }

    /**
     * @param array $array
     *
     * @return array
     */
    private function sortAlphabetically(array $array)
    {
        sort($array);

        return $array;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return static::SKILL_POINT_VALUE;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->getValue();
    }

    /**
     * @return ProfessionLevel
     */
    public function getProfessionLevel()
    {
        return $this->professionLevel;
    }

    /**
     * @return AbstractSkillPoint|null
     */
    public function getFirstPaidSkillPoint()
    {
        return $this->firstPaidSkillPoint;
    }

    /**
     * @return AbstractSkillPoint|null
     */
    public function getSecondPaidSkillPoint()
    {
        return $this->secondPaidSkillPoint;
    }

}
