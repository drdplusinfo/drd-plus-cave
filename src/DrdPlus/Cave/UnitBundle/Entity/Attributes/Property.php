<?php
namespace DrdPlus\Cave\UnitBundle\Entity\Attributes;

use Doctrine\ORM\Mapping as ORM;

/**
 * Property
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Property
{
    const STRENGTH_NAME = 'Síla';
    const STRENGTH_SHORT_NAME = 'Sil';
    const AGILITY_NAME = 'Obratnost';
    const AGILITY_SHORT_NAME = 'Obr';
    const KNACK_NAME = 'Zručnost';
    const KNACK_SHORT_NAME = 'Zrč';
    const CHARISMA_NAME = 'Charisma';
    const CHARISMA_SHORT_NAME = 'Chr';
    const WILL_NAME = 'Vůle';
    const WILL_SHORT_NAME = 'Vol';
    const INTELLIGENCE_NAME = 'Inteligence';
    const INTELLIGENCE_SHORT_NAME = 'Int';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="value", type="integer")
     */
    private $value;

    /**
     * @var string
     *
     * @ORM\Column(name="shortLabel", type="string", length=255)
     */
    private $shortName;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=255)
     */
    private $name;

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
     * Set value
     *
     * @param integer $value
     * @return Property
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return integer
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return string
     */
    public function setName($name)
    {
        return $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set short name
     *
     * @param string $shortName
     * @return string
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;
    }

    /**
     * @return string
     */
    public function getShortName()
    {
        return $this->shortName;
    }
}
