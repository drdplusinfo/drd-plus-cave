<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Property
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Property")
     */
    private $strength;

    /**
     * @var Property
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Property")
     */
    private $agility;

    /**
     * @var Property
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Property")
     */
    private $knack;

    /**
     * @var Property
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Property")
     */
    private $will;

    /**
     * @var Property
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Property")
     */
    private $intelligence;

    /**
     * @var Property
     *
     * @ORM\OneToOne(targetEntity="DrdPlus\Cave\UnitBundle\Entity\Attributes\Property")
     */
    private $charisma;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set strength
     *
     * @param Property $strength
     * @return static
     */
    public function setStrength(Property $strength)
    {
        $strength->setLabel(Property::STRENGTH_LABEL);
        $strength->setShortLabel(Property::STRENGTH_SHORT_LABEL);
        $this->strength = $strength;

        return $this;
    }

    /**
     * Get strength
     *
     * @return Property
     */
    public function getStrength()
    {
        return $this->strength;
    }

    /**
     * @param Property $agility
     * @return static
     */
    public function setAgility(Property $agility)
    {
        $agility->setLabel(Property::AGILITY_LABEL);
        $agility->setShortLabel(Property::AGILITY_SHORT_LABEL);
        $this->agility = $agility;

        return $this;
    }

    /**
     * @return Property
     */
    public function getAgility()
    {
        return $this->agility;
    }

    /**
     * @param Property $charisma
     * @return self
     */
    public function setCharisma(Property $charisma)
    {
        $charisma->setLabel(Property::CHARISMA_LABEL);
        $charisma->setShortLabel(Property::CHARISMA_SHORT_LABEL);
        $this->charisma = $charisma;

        return $this;
    }

    /**
     * @return Property
     */
    public function getCharisma()
    {
        return $this->charisma;
    }

    /**
     * @param Property $intelligence
     * @return self
     */
    public function setIntelligence(Property $intelligence)
    {
        $intelligence->setLabel(Property::INTELLIGENCE_LABEL);
        $intelligence->setShortLabel(Property::INTELLIGENCE_SHORT_LABEL);
        $this->intelligence = $intelligence;

        return $this;
    }

    /**
     * @return Property
     */
    public function getIntelligence()
    {
        return $this->intelligence;
    }

    /**
     * @param Property $knack
     * @return self
     */
    public function setKnack(Property $knack)
    {
        $knack->setLabel(Property::KNACK_LABEL);
        $knack->setShortLabel(Property::KNACK_SHORT_LABEL);
        $this->knack = $knack;

        return $this;
    }

    /**
     * @return Property
     */
    public function getKnack()
    {
        return $this->knack;
    }

    /**
     * @param Property $will
     * @return self
     */
    public function setWill(Property $will)
    {
        $will->setLabel(Property::WILL_LABEL);
        $will->setShortLabel(Property::WILL_SHORT_LABEL);
        $this->will = $will;

        return $this;
    }

    /**
     * @return Property
     */
    public function getWill()
    {
        return $this->will;
    }

}
