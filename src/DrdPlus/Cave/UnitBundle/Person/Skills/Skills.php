<?php
namespace DrdPlus\Cave\UnitBundle\Person\Skills;

use DrdPlus\Cave\UnitBundle\Person\Person;
use DrdPlus\Cave\UnitBundle\Person\Skills\Physical\CombinedSkills;
use DrdPlus\Cave\UnitBundle\Person\Skills\Physical\PhysicalSkills;
use DrdPlus\Cave\UnitBundle\Person\Skills\Physical\PsychicalSkills;
use Granam\Strict\Object\StrictObject;

/**
 * Skills
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Skills extends StrictObject
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
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Person\Person")
     */
    private $person;

    /**
     * @var PhysicalSkills
     */
    private $physicalSkills;

    /**
     * @var PsychicalSkills
     */
    private $psychicalSkills;

    /**
     * @var CombinedSkills
     */
    private $combinedSkills;

    public function __construct()
    {
        $this->physicalSkills = new PhysicalSkills();
        $this->psychicalSkills = new PsychicalSkills();
        $this->combinedSkills = new CombinedSkills();
    }

    public function setPerson(Person $person)
    {
        if (is_null($this->getId()) && is_null($person->getProfessionLevels()->getId())
            && $this !== $person->getProfessionLevels()
        ) {
            throw new \LogicException;
        }

        if ($person->getProfessionLevels()->getId() !== $this->getId()) {
            throw new Exceptions\PersonIsAlreadySet();
        }

        if (!$this->getPerson()) {
            $this->person = $person;
        } elseif ($person->getId() !== $this->getPerson()->getId()) {
            throw new \LogicException();
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
     * Get person
     *
     * @return Person|null
     */
    public function getPerson()
    {
        return $this->person;
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

}
