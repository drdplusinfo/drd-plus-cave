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
    const STRENGTH_CODE = 'strength';
    const STRENGTH_LABEL = 'Síla';
    const STRENGTH_SHORT_LABEL = 'Sil';
    const AGILITY_CODE = 'agility';
    const AGILITY_LABEL = 'Obratnost';
    const AGILITY_SHORT_LABEL = 'Obr';
    const KNACK_CODE = 'knack';
    const KNACK_LABEL = 'Zručnost';
    const KNACK_SHORT_LABEL = 'Zrč';
    const CHARISMA_CODE = 'charisma';
    const CHARISMA_LABEL = 'Charisma';
    const CHARISMA_SHORT_LABEL = 'Chr';
    const WILL_CODE = 'will';
    const WILL_LABEL = 'Vůle';
    const WILL_SHORT_LABEL = 'Vol';
    const INTELLIGENCE_CODE = 'intelligence';
    const INTELLIGENCE_LABEL = 'Inteligence';
    const INTELLIGENCE_SHORT_LABEL = 'Int';

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
     * @ORM\Column(name="code", type="string", length=16)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=255)
     */
    private $label;

    /**
     * @var string
     *
     * @ORM\Column(name="shortLabel", type="string", length=255)
     */
    private $shortLabel;

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
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return Property
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Property
     */
    public function setLabel($name)
    {
        $this->label = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set short name
     *
     * @param string $shortName
     * @return Property
     */
    public function setShortLabel($shortName)
    {
        $this->shortLabel = $shortName;

        return $this;
    }

    /**
     * @return string
     */
    public function getShortLabel()
    {
        return $this->shortLabel;
    }
}
